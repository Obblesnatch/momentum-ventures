<?php
/**
 * Default Header.
 */

// Generate the Language Changer menu.
$language = Language::code();

?>
<!DOCTYPE html>
<html lang="<?= $language; ?>">
<head>
    <meta charset="utf-8">
    <title><?= $title .' - ' .Config::get('app.name', SITETITLE); ?></title>
<?php
echo $meta; // Place to pass data / plugable hook zone

Assets::css([
    template_url('dist/css/bootstrap.min.css', 'Default'),
    template_url('dist/css/bootstrap-theme.min.css', 'Default'),
    'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css',
    template_url('css/style.css', 'Default'),
    template_url('css/select2.min.css', 'Default')
]);

echo $css; // Place to pass data / plugable hook zone
?>
</head>
<body style='padding-top: 28px;'>

<nav class="navbar navbar-default navbar-xs navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="http://justinconabree.com">Justin Conabree</a></li>
            </ul>
        </div>
    </div>
</nav>

<?= $afterBody; // Place to pass data / plugable hook zone ?>

<div class="container">

<p><img src='<?= template_url('images/logo.png', 'Default'); ?>' alt='<?= Config::get('app.name', SITETITLE); ?>'></p>
