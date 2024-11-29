<template>
  <div class="flex min-h-screen">
    <TheSidebarProfessor />
    <Toast position="bottom-left" />
    <main class="flex flex-1 flex-col bg-surface-100 dark:bg-surface-800">
      <TheTopbarProfessor />
      <slot />
    </main>
  </div>
</template>
