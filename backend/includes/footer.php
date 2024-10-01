<div id="toast"></div>
<script>
function showToast(message, position, type) {
    const toast = document.getElementById("toast");
    toast.className = toast.className + " show";
    if (message) toast.innerText = message;
    if (position !== "") toast.className = toast.className + ` ${position}`;
    if (type !== "") toast.className = toast.className + ` ${type}`;
    setTimeout(function () {
        toast.className = toast.className.replace(" show", "");
    }, 3000);
}
</script>


<script src="assets/js/mdb.es.min.js"></script>

<?php
get_message();
?>
<p style="position: fixed; bottom: 0; width: 100%; text-align: center; padding: 1vh 0; background-color: #f1f1f1;">Copyright @ 2024</p>
</body>
</html>