<template>
  <div>
    <div class="rectangle relative">
      <div class="chair chair-1 bg-surface-300 dark:bg-surface-800" />
      <div class="chair chair-2 bg-surface-300 dark:bg-surface-800" />
      <div class="chair chair-3 bg-surface-300 dark:bg-surface-800" />
      <div class="chair chair-4 bg-surface-300 dark:bg-surface-800" />
      <div class="rectangle-fill bg-surface-400 dark:bg-surface-700" />
    </div>
    <!-- <div class="chair" /> -->
  </div>
</template>

<style lang="scss" scoped>
.rectangle {
  aspect-ratio: 16/9;
  width: 100%;
}

.rectangle-fill {
  width: 100%;
  height: 100%;
  position: absolute;
  z-index: 11;
}

.chair {
  width: 40%;
  position: absolute;
  aspect-ratio: 16/9;
  border-radius: 25%;
  z-index: 10;

  &.chair-1 {
    left: 5%;
    top: -15%;
  }

  &.chair-2 {
    right: 5%;
    top: -15%;
  }

  &.chair-3 {
    left: 5%;
    bottom: -15%;
  }

  &.chair-4 {
    right: 5%;
    bottom: -15%;
  }
}
</style>
