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
<p style="text-align:center; padding: 4vh 0;">Copyright @ 2024</>
</body>
</html>