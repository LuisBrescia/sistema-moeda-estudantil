<template>
  <div>
    <div class="square relative">
      <div class="chair chair-1 bg-surface-300 dark:bg-surface-800" />
      <div class="chair chair-2 bg-surface-300 dark:bg-surface-800" />
      <div class="square-fill bg-surface-400 dark:bg-surface-700" />
    </div>
  </div>
</template>

<style lang="scss" scoped>
.square {
  aspect-ratio: 1;
  width: 60%;
}

.square-fill {
  width: 100%;
  height: 100%;
  position: absolute;
  z-index: 11;
}

.chair {
  width: 50%;
  position: absolute;
  aspect-ratio: 16/9;
  border-radius: 25%;
  z-index: 10;

  &.chair-1 {
    left: 50%;
    top: -10%;
    transform: translateX(-50%);
  }

  &.chair-2 {
    left: 50%;
    bottom: -10%;
    transform: translateX(-50%);
  }
}
</style>
