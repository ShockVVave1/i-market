/*var elem = document. querySelectorAll('.add-button');
elem.addEventListener('click',function (event) {
    event.preventDefault();
    var id = this.dataset.id;
    ajaxSend(id);
});
*/
function ajaxSend(id) {
    console.log('product_id=', id);
    var cart = document.querySelector('#cart');
    const req =new XMLHttpRequest();
    req.addEventListener('load', function () {
        var unswer = JSON.parse(this.responseText);
        cart.innerText = 'Корзина ('+unswer.count+')';
    });
    var param = 'product_id='+id;
    req.open('POST','/i-market/cart/addAjax',true );
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    console.log(param);
    req.send(param);

}