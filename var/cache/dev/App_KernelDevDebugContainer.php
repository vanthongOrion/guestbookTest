<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerSaAJ5nw\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerSaAJ5nw/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerSaAJ5nw.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerSaAJ5nw\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerSaAJ5nw\App_KernelDevDebugContainer([
    'container.build_hash' => 'SaAJ5nw',
    'container.build_id' => '587df489',
    'container.build_time' => 1712210979,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerSaAJ5nw');
