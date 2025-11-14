(function($){
wp.customize.bind('ready', function(){
  function controlEl(id){return $('#customize-control-'+id);} 
  function getHidden(id){return controlEl(id).find('input[type="hidden"]');}
  function parseJSON(val){try{return JSON.parse(val);}catch(e){return [];}}
  function setJSON(id,obj){var h=getHidden(id);h.val(JSON.stringify(obj)).trigger('change');}

  var bgId='background_themewebsite';
  (function(){
    var el=controlEl(bgId); if(!el.length) return;
    var hidden=getHidden(bgId);
    var data=hidden.val(); var obj; try{obj=JSON.parse(data);}catch(e){obj={};}
    var color=$('<input type="text" class="widefat" placeholder="background-color">').val(obj['background-color']||'');
    var img=$('<input type="text" class="widefat" placeholder="background-image URL">').val(obj['background-image']||'');
    var pick=$('<button type="button" class="button">Select Image</button>');
    var repeat=$('<select class="widefat"></select>').append([
      '<option value="repeat">repeat</option>',
      '<option value="no-repeat">no-repeat</option>',
      '<option value="repeat-x">repeat-x</option>',
      '<option value="repeat-y">repeat-y</option>'
    ].join('')).val(obj['background-repeat']||'repeat');
    var position=$('<select class="widefat"></select>').append([
      '<option value="left top">left top</option>',
      '<option value="left center">left center</option>',
      '<option value="left bottom">left bottom</option>',
      '<option value="center top">center top</option>',
      '<option value="center center">center center</option>',
      '<option value="center bottom">center bottom</option>',
      '<option value="right top">right top</option>',
      '<option value="right center">right center</option>',
      '<option value="right bottom">right bottom</option>'
    ].join('')).val(obj['background-position']||'center center');
    var size=$('<select class="widefat"></select>').append([
      '<option value="auto">auto</option>',
      '<option value="cover">cover</option>',
      '<option value="contain">contain</option>'
    ].join('')).val(obj['background-size']||'cover');
    var attachment=$('<select class="widefat"></select>').append([
      '<option value="scroll">scroll</option>',
      '<option value="fixed">fixed</option>',
      '<option value="local">local</option>'
    ].join('')).val(obj['background-attachment']||'scroll');
    var wrap=$('<div/>');
    wrap.append($('<label/>').text('Background Color')).append(color);
    wrap.append($('<label/>').text('Background Image')).append(img).append(pick);
    wrap.append($('<label/>').text('Repeat')).append(repeat);
    wrap.append($('<label/>').text('Position')).append(position);
    wrap.append($('<label/>').text('Size')).append(size);
    wrap.append($('<label/>').text('Attachment')).append(attachment);
    el.append(wrap);
    function update(){
      var o={
        'background-color': color.val(),
        'background-image': img.val(),
        'background-repeat': repeat.val(),
        'background-position': position.val(),
        'background-size': size.val(),
        'background-attachment': attachment.val()
      };
      setJSON(bgId,o);
    }
    color.on('input change',update);
    img.on('input change',update);
    repeat.on('change',update);
    position.on('change',update);
    size.on('change',update);
    attachment.on('change',update);
    pick.on('click',function(){
      var frame=wp.media({multiple:false});
      frame.on('select',function(){
        var url=frame.state().get('selection').first().toJSON().url; img.val(url); update();
      });
      frame.open();
    });
  })();

  function initRepeater(id, fields, limit, meta){
    var el=controlEl(id); if(!el.length) return; var hidden=getHidden(id);
    var arr=parseJSON(hidden.val()); if(!Array.isArray(arr)) arr=[];
    var list=$('<div class="velocity-repeater-list"/>'); var addText=(meta&&meta.addLabel)?meta.addLabel:'Add'; var add=$('<button type="button" class="button"></button>').text(addText);
    function render(){
      list.empty();
      arr.forEach(function(item,idx){
        var row=$('<div class="velocity-repeater-item"/>');
        fields.forEach(function(f){
          var label=(meta&&meta.labels&&meta.labels[f])?meta.labels[f]:f;
          var desc=(meta&&meta.descriptions&&meta.descriptions[f])?meta.descriptions[f]:'';
          var input;
          if(f==='velocity_text'){
            input=$('<textarea class="widefat" rows="4"/>').val(item[f]||'');
          }else{
            input=$('<input type="text" class="widefat"/>').val(item[f]||'');
          }
          input.on('input change',function(){ item[f]=input.val(); sync(); });
          row.append($('<label/>').text(label));
          if(desc){ row.append($('<small class="description"/>').text(desc)); }
          row.append(input);
        });
        var pickers={};
        fields.filter(function(f){return /image$/.test(f);}).forEach(function(f){
          var pick=$('<button type="button" class="button">Select Image</button>');
          pick.on('click',function(){
            var frame=wp.media({multiple:false});
            frame.on('select',function(){
              var url=frame.state().get('selection').first().toJSON().url; item[f]=url; render(); sync();
            });
            frame.open();
          });
          row.append(pick);
        });
        var del=$('<button type="button" class="button">Remove</button>');
        del.on('click',function(){ arr.splice(idx,1); render(); sync(); });
        row.append(del);
        list.append(row);
      });
    }
    function sync(){ setJSON(id,arr); }
    add.on('click',function(){ if(arr.length>=limit) return; var obj={}; fields.forEach(function(f){obj[f]='';}); arr.push(obj); render(); sync(); });
    el.append(list).append(add);
    render(); sync();
  }

  initRepeater('velocity_layanan_repeat', ['velocity_layanan_image','velocity_layanan','velocity_icon','velocity_text','velocity_link'], 3, {
    addLabel: 'Add Layanan',
    labels: {
      'velocity_layanan_image': 'Gambar',
      'velocity_layanan': 'Judul Layanan',
      'velocity_icon': 'Icon Layanan (Font Awesome v5)',
      'velocity_text': 'Deskripsi Layanan',
      'velocity_link': 'Link Layanan'
    },
    descriptions: {
      'velocity_layanan_image': 'Ukuran 410 x 270 pixel.',
      'velocity_icon': 'Isi nama icon, list: fontawesome.com/v5/search?o=r&m=free'
    }
  });
  initRepeater('velocity_gallery_repeat', ['velocity_gallery_image'], 10);
  initRepeater('velocity_logo_repeat', ['velocity_logo_image'], 10);
});
})(jQuery);