</php 
session_start();

$__jobsheetRoot = dirname(__DIR__)
$__scriptDir = dirname($_SERVER['SCRIPT_FILENAME']);
$__rel = ltrim(str_replace('\\', '/', substr($__scriptDir, strlen($__jobsheetRoot))), '/');
$base = $__rel === '' ? '': str_repeat('../', substr_count($__rel, '/')+1);
?>


</main>
    <footer>
        <p>&copy; 2026 SIMPUS-mini &mdash; Jobsheet 1</p>
    </footer>
    <script src="../assets/js/app.js"></script>
    <script src="../assets/js/buku.js"></script>
</body>
</html>