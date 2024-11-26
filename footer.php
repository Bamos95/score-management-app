<!-- footer file -->
<div class="container bg-light">
    <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5 border-top">
        <div class="col mb-3">
            <p class="text-body-secondary">SPORTSCORES</p>
            <p class="text-body-secondary">&copy; 2023</p>
        </div>

        <div class="col mb-3">

        </div>

        <?php
        if (!empty($_SESSION['user'])) {
        ?>
            <div class="col mb-3">
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="matches.php" class="nav-link p-0 text-body-secondary">Matches à venir</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Le tournoir</a></li>
                </ul>
            </div>

            <div class="col mb-3">
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="team.php" class="nav-link p-0 text-body-secondary">Les equipes</a></li>
                    <li class="nav-item mb-2"><a href="leaderboard.php" class="nav-link p-0 text-body-secondary">Le Classements</a></li>
                </ul>
            </div>
        <?php
        }

        ?>
    </footer>
</div>