<!-- Roles -->
<?php foreach($rolePermission as $rolePerms):?>
    <?php $access = false;?>
    <?php if($rolePerms['perm_mod'] == 'ROLE'):?>
        <li class="nav-item">
            <a href="<?= base_url('admin/roles')?>" class="nav-link <?= $active=="roles" ? 'active': ''?>">
                <i class="nav-icon fas fa-user-tag"></i>
                <p>
                    Roles
                </p>
            </a>
        </li>
        <?php $access = true;?>
    <?php endif;?>
    <?php if($access){
        break;
    }?>
<?php endforeach;?>

<!-- Permissions -->
<?php foreach($rolePermission as $rolePerms):?>
    <?php $access = false;?>
    <?php if($rolePerms['perm_mod'] == 'PERM'):?>
        <li class="nav-item">
            <a href="<?= base_url('admin/permissions')?>" class="nav-link <?= $active=="permissions" ? 'active': ''?>">
                <i class="nav-icon fas fa-universal-access"></i>
                <p>
                    Permissions
                </p>
            </a>
        </li>
        <?php $access = true;?>
    <?php endif;?>
    <?php if($access){
        break;
    }?>
<?php endforeach;?>

<!-- Announcements -->
<?php foreach($rolePermission as $rolePerms):?>
    <?php $access = false;?>
    <?php if($rolePerms['perm_mod'] == 'ANN'):?>
        <li class="nav-item">
            <a href="<?= base_url('admin/announcements')?>" class="nav-link <?= $active=="announcements" ? 'active': ''?>">
                <i class="nav-icon fas fa-bullhorn"></i>
                <p>
                    Announcements
                </p>
            </a>
        </li>
        <?php $access = true;?>
    <?php endif;?>
    <?php if($access){
        break;
    }?>
<?php endforeach;?>

<!-- Sliders -->
<?php foreach($rolePermission as $rolePerms):?>
    <?php $access = false;?>
    <?php if($rolePerms['perm_mod'] == 'SLID'):?>
        <li class="nav-item">
            <a href="<?= base_url('admin/sliders')?>" class="nav-link <?= $active=="sliders" ? 'active': ''?>">
                <i class="nav-icon fas fa-bullhorn"></i>
                <p>
                    Sliders
                </p>
            </a>
        </li>
        <?php $access = true;?>
    <?php endif;?>
    <?php if($access){
        break;
    }?>
<?php endforeach;?>

