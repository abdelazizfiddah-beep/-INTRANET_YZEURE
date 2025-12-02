</main>

<?php if (isLoggedIn()): ?>
    <footer class="main-footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Ville d'Yzeure - Tous droits réservés</p>
            <p>Intranet municipal - Version 1.0</p>
        </div>
    </footer>
<?php endif; ?>

<script src="<?php echo BASE_URL; ?>/js/main.js"></script>
</body>

</html>