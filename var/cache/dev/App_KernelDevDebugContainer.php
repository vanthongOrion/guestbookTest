<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container0R3Y5GG\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container0R3Y5GG/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/Container0R3Y5GG.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\Container0R3Y5GG\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \Container0R3Y5GG\App_KernelDevDebugContainer([
    'container.build_hash' => '0R3Y5GG',
    'container.build_id' => '5c025306',
    'container.build_time' => 1712284173,
], __DIR__.\DIRECTORY_SEPARATOR.'Container0R3Y5GG');
