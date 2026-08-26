<?php
// Shared navigation bar.
// Expects (optionally) $activeNav to be set by the including page to one of:
// 'home', 'programs', 'activities', 'about', 'login', 'register'
//
// Requires a session. If the including page hasn't started one yet
// (e.g. a plain page with no other session logic), start it here —
// but note session_start() must run before ANY output, so pages that
// output HTML before including this file must call session_start()
// themselves at the very top of the file instead.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['user_id']);
$displayName = $isLoggedIn ? htmlspecialchars($_SESSION['first_name']) : '';
$activeNav = $activeNav ?? '';
?>
<!-- Navigation -->
<nav>
    <div class="logo">DE LA SALLE LIPA</div>

    <ul>
        <li>
            <a href="index.php#home" class="nav-link<?php echo $activeNav === 'home' ? ' active' : ''; ?>">HOME</a>
        </li>

        <li>
            <a href="index.php#programs" class="nav-link<?php echo $activeNav === 'programs' ? ' active' : ''; ?>">PROGRAMS</a>
        </li>

        <li>
            <a href="index.php#activities" class="nav-link<?php echo $activeNav === 'activities' ? ' active' : ''; ?>">ACTIVITIES</a>
        </li>

        <li>
            <a href="index.php#about" class="nav-link<?php echo $activeNav === 'about' ? ' active' : ''; ?>">ABOUT</a>
        </li>

        <?php if ($isLoggedIn): ?>
            <!-- Logged-in state: username + dropdown -->
            <li class="auth-menu">
                <button type="button" class="username-btn" id="usernameBtn" aria-haspopup="true" aria-expanded="false">
                    <?php echo $displayName; ?>
                    <span class="caret" aria-hidden="true">&#9662;</span>
                </button>

                <ul class="dropdown-menu" id="dropdownMenu" role="menu">
                    <li role="none">
                        <a href="logout.php" class="dropdown-item" role="menuitem">Log Out</a>
                    </li>
                </ul>
            </li>
        <?php else: ?>
            <!-- Logged-out state: login / register -->
            <li>
                <a href="login.php" class="nav-link<?php echo $activeNav === 'login' ? ' active' : ''; ?>">LOGIN</a>
            </li>

            <li>
                <a href="register.php" class="nav-link<?php echo $activeNav === 'register' ? ' active' : ''; ?>">REGISTER</a>
            </li>
        <?php endif; ?>

        <li>
            <a href="https://my.dlsl.edu.ph/padmission?campus=WjlBbzRFTnhBZGkxdG50VmxUTVRjdz09&dept="
                class="apply-btn" target="_blank">
                APPLY NOW
            </a>
        </li>
    </ul>
</nav>
