/**
 * Created by elom on 26/07/2017.
 */
function openModal()
{
document.getElementById("notification").style.top="-20px";
document.getElementById("notification").style.height="110px";
$(".chosen-select").chosen();

}
/*
setTimeout(function()
{document.getElementById("notification").style.right="-500px";},2000);
*/
setTimeout(function()
{

var notification =document.getElementById("notification");
    for (var i = 0.9 ; i >= 0.0 ; i -= 0.01)
    {
        notification.style.opacity = i;
    }
},3000);




