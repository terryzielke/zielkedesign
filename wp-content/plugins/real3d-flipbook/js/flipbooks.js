var R3D=R3D||{};!function(t){var e,o,a,i;"undefined"!=typeof flipbooks_json&&(e=flipbooks_json[0],o="flipbooks",a="data:text/json;charset=utf-8,"+encodeURIComponent(e),(i=document.createElement("a")).setAttribute("href",a),i.setAttribute("download",o+".json"),document.body.appendChild(i),i.click(),i.remove()),t(".copy-json").click((function(){var t=document.getElementById("copy-text-hidden");t.value=json,t.select(),document.execCommand("copy")})),R3D.EditFlipbooks=function(){this.books=t.parseJSON(flipbooks[0]);var e=[];for(var o in this.books)e.push(this.books[o]);this.books=e;var a=this,i=t("#flipbooks-table"),n="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=";function s(e){t('<tr><th scope="row" class="manage-column column-cb check-column"><input type="checkbox" class="row-checkbox" name="'+e.id+'"></th>      <td style="vertical-align: top;"><a href="#" class="edit" name="'+e.id+'"><div style="height:100px; width: 70px;background-image:url('+(e.thumb||n)+');background-color:transparent;background-size:contain;background-position:center;background-repeat:no-repeat;"></a></td><td style="vertical-align: top;"><strong><a href="#" class="edit" title="Edit" name="'+e.id+'">'+e.name+'</a></strong><div class="row-actions"><span name="'+e.id+'" class="edit"><a href="#" title="Edit this item">Edit</a> | </span><span class="inline hide-if-no-js duplicate" name="'+e.id+'"><a href="#" title="Duplicate flipbook" >Duplicate</a> | </span><span class="trash" name="'+e.id+'" ><a href="#" title="Move to trash" >Trash</a></span></div></td><td>[real3dflipbook id="'+e.id+'"]   <div id="'+e.id+'" class="button-secondary copy-shortcode">Copy</div>        </td><td>'+e.date+"</td></tr>").appendTo(i)}var l=[];for(var o in this.books)l.push(o),void 0===this.books[o].date&&(this.books[o].date="");function c(t){var e=1;return"-"===t[0]&&(e=-1,t=t.substr(1)),function(o,a){return(o[t]<a[t]?-1:o[t]>a[t]?1:0)*e}}this.books.sort(c("date")),this.books.reverse();var r=20,d=0,p=parseInt(l.length/r)+1;function u(e){t("#flipbooks-table").empty();for(var o=r*e;o<r*(e+1);o++){var i=a.books[o];i&&s(i)}t(".current-page").val(e+1),t(".edit").click((function(t){t.preventDefault();var e=this.getAttribute("name");window.location=window.location.origin+window.location.pathname+"?page=real3d_flipbook_admin&action=edit&bookId="+e})),t(".duplicate").click((function(e){e.preventDefault(),function(e){var o="action=r3d_duplicate&security="+window.r3d_nonce[0]+"&currentId="+e;t.ajax({type:"POST",url:"admin-ajax.php?page=real3d_flipbook_admin",data:o,success:function(t,e,o){location.href=location.origin+location.pathname+"?page=real3d_flipbook_admin"},error:function(t,e,o){alert("Status: "+e),alert("Error: "+o)}})}(this.getAttribute("name"))})),t(".import").click((function(e){e.preventDefault(),function(){var e=t("#flipbook-admin-json").val();e=JSON.stringify(JSON.parse(e)),confirm("Import flipbooks from JSON. This will delete any existing flipbooks. Are you sure?")&&t.ajax({type:"POST",url:"admin-ajax.php?page=real3d_flipbook_admin",data:{flipbooks:e,security:window.r3d_nonce[0],action:"r3d_import"},success:function(t,e,o){location.href=location.origin+location.pathname+"?page=real3d_flipbook_admin"},error:function(t,e,o){alert("Status: "+e),alert("Error: "+o)}})}()})),t(".trash").click((function(t){t.preventDefault(),h(this.getAttribute("name"))})),t(".undo").click((function(t){t.preventDefault(),window.location=window.location.origin+window.location.pathname+"?page=real3d_flipbook_admin&action=undo"}))}function h(e){var o="",a="action=r3d_delete&security="+window.r3d_nonce[0];e?(o=1==e.length?"Deleete flipbook "+e:"Delete flipbooks "+e,a+="&currentId="+e):o="Delete all flipbooks",confirm(o+". Are you sure?")&&t.ajax({type:"POST",url:"admin-ajax.php?page=real3d_flipbook_admin",data:a,success:function(t,e,o){location.href=location.origin+location.pathname+"?page=real3d_flipbook_admin"},error:function(t,e,o){alert("Status: "+e),alert("Error: "+o)}})}l.length<r&&t(".tablenav-pages").addClass("one-page"),t(".total-pages").text(p),t(".displaying-num").text(l.length+" items"),t(".items-20").click((function(){r=100,p=parseInt(l.length/r)+1,u(0),l.length<r&&t(".tablenav-pages").addClass("one-page"),t(".total-pages").text(p),t(".displaying-num").text(l.length+" items")})),t(".items-100").click((function(){r=100,p=parseInt(l.length/r)+1,u(0),l.length<r&&t(".tablenav-pages").addClass("one-page"),t(".total-pages").text(p),t(".displaying-num").text(l.length+" items")})),t(".items-all").click((function(){r=l.length,p=1,u(0),l.length<r&&t(".tablenav-pages").addClass("one-page"),t(".total-pages").text(p),t(".displaying-num").text(l.length+" items")})),t("#name").click((function(){t(this).toggleClass("asc"),t(this).toggleClass("desc"),a.books.sort(c("name")),t(this).hasClass("asc")&&a.books.reverse(),u(0)})),t("#date").click((function(){t(this).toggleClass("asc"),t(this).toggleClass("desc"),a.books.sort(c("date")),t(this).hasClass("asc")&&a.books.reverse(),u(0)})),u(d),t(".first-page").click((function(){u(d=0)})),t(".prev-page").click((function(){d>0&&d--,u(d)})),t(".next-page").click((function(){d<p-1&&d++,u(d)})),t(".last-page").click((function(){u(d=p-1)})),t(".bulkactions-apply").click((function(){if("-1"!=t(this).parent().find("select").val()){var e=[];t(".row-checkbox").each((function(){t(this).is(":checked")&&e.push(t(this).attr("name"))})),e.length>0&&h(e)}})),t(".copy-shortcode").click((function(){var e="[real3dflipbook id='"+t(this).attr("id")+"']";if(navigator.clipboard)navigator.clipboard.writeText(e).then((()=>{t(this).text("Copied!"),setTimeout((()=>{t(this).text("Copy")}),2e3)})).catch((()=>{t(this).text("Error"),setTimeout((()=>{t(this).text("Copy")}),2e3)}));else{var o=document.createElement("textarea");o.value=e,document.body.appendChild(o),o.select(),document.execCommand("copy"),document.body.removeChild(o),t(this).text("Copied!"),setTimeout((()=>{t(this).text("Copy")}),2e3)}})),t(".delete-all-flipbooks").click((function(t){t.preventDefault(),h()}))},t(document).ready((function(){new R3D.EditFlipbooks}))}(jQuery);