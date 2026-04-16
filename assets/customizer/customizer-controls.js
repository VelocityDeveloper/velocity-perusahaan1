(function($){
if(!(window.wp && wp.customize)){ return; }
wp.customize.bind('ready', function(){
function logErr(err, ctx){
  try{
    console.error('Velocity Customizer Error:', ctx, err);
    var box = $('#velocity-debug-box');
    if(!box.length){
      box = $('<div id="velocity-debug-box" style="position:fixed;left:10px;right:10px;bottom:10px;padding:8px;background:#fee;border:1px solid #c00;color:#900;z-index:99999;font-size:12px"></div>');
      $('body').append(box);
    }
    var msg = (err && err.message) ? err.message : String(err);
    box.append($('<div/>').text(ctx+': '+msg));
  }catch(e){ /* noop */ }
}
  function controlEl(id){return $('#customize-control-'+id);} 
  function getVal(id){
    var control = wp.customize.control(id);
    var setting = control && control.setting ? control.setting : wp.customize(id);
    var v = (setting && typeof setting.get === 'function') ? setting.get() : null;
    if(v === null || typeof v === 'undefined'){
      var h = controlEl(id).find('input[type="hidden"]').first().val();
      try{ v = JSON.parse(h); }catch(e){ v = []; }
    }
    return v;
  }
  function setVal(id,obj){
    var cloned; try{ cloned=JSON.parse(JSON.stringify(obj)); }catch(e){ cloned=obj; }
    var control = wp.customize.control(id);
    var setting = control && control.setting ? control.setting : wp.customize(id);
    try{
      if(setting && typeof setting.set === 'function'){
        setting.set(cloned);
      }
    }catch(e){ logErr(e,'setVal:'+id); }
    var inputHidden = controlEl(id).find('input[type="hidden"]').first();
    if(inputHidden.length){ inputHidden.val(JSON.stringify(cloned)).trigger('change'); }
  } 
  function ensureObj(v){ if(typeof v==='string'){ try{ v=JSON.parse(v); }catch(e){ v={}; } } if(typeof v!=='object'||v===null){ v={}; } return v; }
  function ensureArr(v){ if(typeof v==='string'){ try{ v=JSON.parse(v); }catch(e){ v=[]; } } if(!Array.isArray(v)){ v=[]; } return v; }

  function initRepeater(id, fields, limit, meta){
    var el=controlEl(id); if(!el.length) return;
    var arr=ensureArr(getVal(id));
    try{ arr=JSON.parse(JSON.stringify(arr)); }catch(e){}
    if(arr.length===0){ var obj={}; fields.forEach(function(f){obj[f]='';}); arr=[obj]; }
    var list=$('<div class="velocity-repeater-list"/>'); var addText=(meta&&meta.addLabel)?meta.addLabel:'Add'; var add=$('<button type="button" class="button"></button>').text(addText);
    var openIndex=0;
    function render(targetIndex){
      if(typeof targetIndex==='number'){ openIndex=targetIndex; }
      list.empty();
      arr.forEach(function(item,idx){
        var row=$('<div class="velocity-repeater-item"/>');
        var title=(meta&&meta.itemTitlePrefix?meta.itemTitlePrefix:'Item')+' '+(idx+1);
        var header=$('<div class="velocity-repeater-header"><span class="title">'+title+'</span><span class="dashicons dashicons-arrow-down"></span></div>');
        var body=$('<div class="velocity-repeater-body"/>');
        header.on('click', function(){ 
          var open=row.toggleClass('is-open').hasClass('is-open');
          body.toggle(open);
          header.find('.dashicons').toggleClass('dashicons-arrow-down', open).toggleClass('dashicons-arrow-right', !open);
          if(open){ openIndex=idx; }
        });
        var itemActionsWrap=null;
        fields.forEach(function(f){
          var label=(meta&&meta.labels&&meta.labels[f])?meta.labels[f]:f;
          var desc=(meta&&meta.descriptions&&meta.descriptions[f])?meta.descriptions[f]:'';
          var input;
          if(f==='velocity_text'){
            input=$('<textarea class="widefat" rows="4"/>').val(item[f]||'');
          }else{
            input=$('<input type="text" class="widefat"/>').val(item[f]||'');
          }
          var frame=$('<div class="velocity-image-frame"/>');
          var preview=null;
          if(/image$/.test(f)){
            var src=item[f]||'';
            preview=$('<img/>').attr('src',src).css({maxWidth:'100%',height:'auto',display:src?'block':'none'});
            frame.append(preview);
          }
          var selectBtn=null, changeBtn=null;
          if(/image$/.test(f)){
            selectBtn=$('<button type="button" class="button">Select Image</button>');
            changeBtn=$('<button type="button" class="button">Change Image</button>');
            input.addClass('velocity-hidden');
            if(!itemActionsWrap){ itemActionsWrap=$('<div class="velocity-image-actions"/>'); }
            selectBtn.on('click',function(){
              var media=wp.media({multiple:false});
              media.on('select',function(){
                var url=media.state().get('selection').first().toJSON().url;
                item[f]=url; input.val(url);
                if(preview){ preview.attr('src',url).css('display',url?'block':'none'); }
                if(selectBtn){ selectBtn.hide(); }
                if(changeBtn){ changeBtn.show(); }
                sync();
              });
              media.open();
            });
            changeBtn.on('click',function(){
              var media=wp.media({multiple:false});
              media.on('select',function(){
                var url=media.state().get('selection').first().toJSON().url;
                item[f]=url; input.val(url);
                if(preview){ preview.attr('src',url).css('display',url?'block':'none'); }
                if(selectBtn){ selectBtn.hide(); }
                if(changeBtn){ changeBtn.show(); }
                sync();
              });
              media.open();
            });
          }
          var hideLabel = !!(meta && meta.hideImageLabel && /image$/.test(f));
          if(!hideLabel){ body.append($('<label/>').text(label)); }
          if(desc && !hideLabel){ body.append($('<small class="description"/>').text(desc)); }
          if(preview){ body.append(frame); }
          body.append(input);
          if(itemActionsWrap){
            itemActionsWrap.append(selectBtn).append(changeBtn);
            if(!body.find('.velocity-image-actions').length){ body.append(itemActionsWrap); }
          } else {
            if(selectBtn){ body.append(selectBtn); }
            if(changeBtn){ body.append(changeBtn); }
          }
          if(/image$/.test(f)){
            var has=!!(item[f]);
            if(has){ if(selectBtn){ selectBtn.hide(); } if(changeBtn){ changeBtn.show(); } }
            else { if(selectBtn){ selectBtn.show(); } if(changeBtn){ changeBtn.hide(); } }
          }
          input.on('input change',function(){ 
            item[f]=input.val(); 
            if(/image$/.test(f) && preview){
              preview.attr('src', item[f]||'').css('display', item[f] ? 'block':'none');
            }
            sync(); 
          });
        });
        if(itemActionsWrap){
          var del=$('<button type="button" class="button">Remove Item</button>');
          del.on('click',function(){ arr.splice(idx,1); render(); sync(); });
          itemActionsWrap.append(del);
        } else {
          var del=$('<button type="button" class="button">Remove Item</button>');
          del.on('click',function(){ arr.splice(idx,1); render(); sync(); });
          body.append(del);
        }
        row.append(header).append(body);
        var defaultOpen = (idx===openIndex);
        row.toggleClass('is-open', defaultOpen);
        body.toggle(defaultOpen);
        header.find('.dashicons').toggleClass('dashicons-arrow-down', defaultOpen).toggleClass('dashicons-arrow-right', !defaultOpen);
        list.append(row);
      });
    }
    function sync(){ var next; try{ next=JSON.parse(JSON.stringify(arr)); }catch(e){ next=arr; } setVal(id,next); }
    add.on('click',function(){ if(arr.length>=limit) return; var obj={}; fields.forEach(function(f){obj[f]='';}); arr=[].concat(arr,[obj]); render(arr.length-1); sync(); });
    el.append(list).append(add);
    render(openIndex);
  }

  initRepeater('velocity_layanan_repeat', ['velocity_layanan_image','velocity_layanan','velocity_icon','velocity_text','velocity_link'], 3, {
    addLabel: 'Add Layanan',
    labels: {
      'velocity_layanan_image': 'Gambar',
      'velocity_layanan': 'Judul Layanan',
      'velocity_icon': 'Icon Layanan (Bootstrap Icons)',
      'velocity_text': 'Deskripsi Layanan',
      'velocity_link': 'Link Layanan'
    },
    descriptions: {
      'velocity_layanan_image': 'Ukuran 410 x 270 pixel.',
      'velocity_icon': 'Isi nama icon (tanpa prefix), list: icons.getbootstrap.com'
    }
  });
  try{ initRepeater('velocity_gallery_repeat', ['velocity_gallery_image'], 10, { addLabel: 'Add Gambar', itemTitlePrefix: 'Gambar', hideImageLabel: true }); }catch(e){ logErr(e,'initRepeater:gallery'); }
  try{ initRepeater('velocity_logo_repeat', ['velocity_logo_image'], 10, { addLabel: 'Add Logo', itemTitlePrefix: 'Logo', hideImageLabel: true }); }catch(e){ logErr(e,'initRepeater:logo'); }
});
})(jQuery);
