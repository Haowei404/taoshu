"use strict";$(function(){var e;function c(){var e=[];return $(".s-chk input").each(function(t,n){$(n).prop("checked")&&e.push(t)}),e}function s(){var e=c(),a=0,o=0;e.forEach(function(t,n){a+=$("#cartcontent .text-amount").eq(e[n]).val()-0,o+=$("#cartcontent .s-total em").eq(e[n]).html()-0}),$("#totalnum").html(a),$(".total-price .total").html(o),$("#total2").html(o);var t=$(".s-chk input").length,n=$(".s-chk input:checked").length;t==n&&0!=n?$("#SelectAll").prop("checked",!0):$("#SelectAll").prop("checked",!1)}function n(t,n){console.log(t);var e=$(t).parent().find(".text-amount").data("num");e<n?(alert("超过库存"),n=e):n<1&&(n=1),t.parent().find(".text-amount").val(n);var a=t.parent().parent().find(".s-price em").html(),o=t.parent().parent().find(".s-point em").html().slice(0,2),c=(n*a-a*o/100*n).toFixed(2),i=(n*a*o/100).toFixed(2);t.parent().parent().find(".s-total em").html(i),t.parent().parent().find(".s-agio em").html(c),s()}$("#header #site-nav").load("site-nav.html"),$("#header .public_header").load("public_header.html"),$("#footer").load("footer.html"),e="",new Promise(function(n){$.ajax({type:"post",url:"../api/cart.php",data:{mes:"selid",uid:getCookie("uid")},dataType:"json",success:function(t){n(t)}})}).then(function(t){t.forEach(function(t){var n=t.number;new Promise(function(n){$.ajax({type:"post",url:"../api/list.php",data:{mes:"seleid",id:t.goods_id},dataType:"json",success:function(t){n(t)}})}).then(function(t){e+=' <tr class="enable" data-goodid="'+t[0].id+'">\n                                    <td class="s-chk">\n                                        <input type="checkbox">\n                                    </td>\n                                    <td class="s-title">\n                                        <a href="" class="cartimg">\n                                            <img src="'+t[0].image+'" alt="">\n                                        </a>\n                                        <a href="" class="carttile">\n                                            '+t[0].name+'\n                                        </a>\n                                        <div class="props">\n                                            <span>\n                                                品类: 正价\n                                            </span>\n                                        </div>\n                                    </td>\n                                    <td class="s-price">\n                                        <em>'+t[0].old_price+'</em>\n                                    </td>\n                                    <td class="s-point">\n                                        <em>'+t[0].discount+'折</em>\n                                    </td>\n                                    <td class="s-amount">\n                                        <a href="javascript:void(0)" class="cutnum">-</a>\n                                        <input type="text" class="text text-amount" data-num=\''+t[0].stock+"' value=\""+n+'">\n                                        <a href="javascript:void(0)" class="addnum">+</a>\n                                    </td>\n                                    <td class="s-agio">\n                                        <em>'+(n*t[0].old_price-n*t[0].old_price*t[0].discount/100).toFixed(2)+'</em>\n                                    </td>\n                                    <td class="s-total">\n                                        <em>'+(n*t[0].old_price*t[0].discount/100).toFixed(2)+'</em>\n                                    </td>\n                                    <td class="s-del">\n                                        <a href="javascript:void(0)" class="J_Fav">收藏</a>\n                                        <a href="javascript:void(0)" class="J_Del">删除</a>\n                                    </td>\n                                </tr>',$("#cartcontent").html(e)})})}),$("#cartcontent").on("click",".s-chk input",function(){s()}),$("#SelectAll").click(function(){var t=$("#SelectAll").prop("checked");console.log(t),console.log($(".s-chk input")),$(".s-chk input").prop("checked",t),s()}),$("#cartcontent").on("click",".addnum",function(){var t=this,e=$(this).prev().val();e++,new Promise(function(n){$.ajax({url:"../api/cart.php",type:"get",data:{mes:"update",uid:getCookie("uid"),goods_id:$(t).parent().parent().data("goodid"),num:e},success:function(t){n(t)}})}).then(function(t){}),n($(this),e)}),$("#cartcontent").on("click",".cutnum",function(){var t=this,e=$(this).next().val();e--,new Promise(function(n){$.ajax({url:"../api/cart.php",type:"get",data:{mes:"update",num:e,uid:getCookie("uid"),goods_id:$(t).parent().parent().data("goodid")},success:function(t){n(t)}})}).then(function(t){console.log(t)}),n($(this),e)}),$("#cartcontent").on("input",".text-amount",function(){var t=$(this).val();n($(this),t)}),$("#cartcontent").on("click",".J_Del",function(){var t=this;confirm("确定要删除这件商品吗？")&&(new Promise(function(n){$.ajax({url:"../api/cart.php",type:"post",data:{mes:"del",goods_id:$(t).parent().parent().data("goodid"),uid:getCookie("uid")},success:function(t){n(t)}})}).then(function(t){}),$(this).parent().parent().remove())}),$(".del-items").click(function(){if(confirm("你确定要删除这些商品吗？")){var e=c().reverse();e.forEach(function(t,n){new Promise(function(t){$.ajax({url:"../api/cart.php",type:"post",data:{mes:"del",uid:getCookie("uid"),goods_id:$("#cartcontent tr").eq(e[n]).data("goodid")}})}).then(function(t){console.log(t)}),$("#cartcontent tr").eq(e[n]).remove()})}s()}),$(".del-all").click(function(){confirm("你确定要清空购物车吗")&&($("#cartcontent tr").each(function(t,n){var e=$("#cartcontent tr").eq(t).data("goodid");new Promise(function(n){$.ajax({url:"../api/cart.php",type:"get",data:{mes:"del",uid:getCookie("uid"),goods_id:e},success:function(t){n(t)}})}).then(function(t){console.log(t)})}),$("#cartcontent tr").remove())})});