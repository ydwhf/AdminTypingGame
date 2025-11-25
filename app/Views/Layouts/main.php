    <?= $this->include('layouts/header') ?>
    <div id="app">
        <?= $this->include('layouts/sidebar') ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div id="main-content">
                <?= $this->renderSection('content') ?>
            </div>

            <?= $this->include('layouts/footer') ?>
        </div>
    </div>