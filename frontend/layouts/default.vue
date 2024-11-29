<template>
  <div class="flex min-h-screen flex-col bg-surface-50 dark:bg-surface-950">
    <TheNavbar />
    <div class="mb-16 mt-8 grid flex-1 items-center">
      <slot />
    </div>
    <TheFooter />
  </div>
</template>

<style scoped>
.super-gradient {
  /* background: linear-gradient(
    90deg,
    #0f172a,
    #111827,
    #18181b,
    #171717,
    #1c1917
  ); */
  /* background-size: 600% 600%; */
  /* animation: gradient 10s ease infinite; */
  text-align: center;
  padding: 0.25rem;
  font-weight: bold;
  font-size: 1rem;
}

/* .dark .super-gradient {
  background: linear-gradient(
    90deg,
    #cbd5e1,
    #d1d5db,
    #e4e4e7,
    #d4d4d4,
    #e7e5e4
  );
} */

@keyframes gradient {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0% 50%;
  }
}
</style>
