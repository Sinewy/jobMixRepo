<!--    <p><img src="images/footer-jub-logo.png" /> © Skupina JUB 2014 Vse pravice pridržane | <a href="#">Pravno obvestilo</a></p>-->
<!--    <p>Izvedba: VirtuaIT, d.o.o.</p>-->
<!--</footer>-->
<!--END Footer Row-->

<script src="js/jquery.js"></script>
<script src="js/jquery-ui.js"></script>
<script>
    var lang = <?php echo json_encode($lang); ?>;
//    var test = true;
</script>
<script src="js/main.js"></script>

</body>
</html>

<?php
if (isset($conneciton)) {
    mysqli_close($conneciton);
}
?>