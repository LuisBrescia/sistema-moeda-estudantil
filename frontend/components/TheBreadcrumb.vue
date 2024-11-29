<script setup>
import { useBreadcrumbStore } from '@/stores/breadcrumbStore';

const breadcrumbStore = useBreadcrumbStore();
const breadcrumbs = computed(() => breadcrumbStore.breadcrumb);
</script>

<template>
  <div class="flex items-center gap-2" :key="breadcrumbStore.key">
    <NuxtLink to="/home" class="c-breadcrumb__item">
      <IconHouse :size="16" />
    </NuxtLink>
    <template v-for="(route, index) in breadcrumbs" :key="route.to">
      <IconChevronRight class="c-breadcrumb__divider" :size="16" />
      <NuxtLink
        :class="[
          'c-breadcrumb__item',
          {
            'c-breadcrumb__item--active': index === breadcrumbs.length - 1,
          },
        ]"
        :to="route.to"
      >
        {{ route.name }}
      </NuxtLink>
    </template>
  </div>
</template>

<style lang="scss" scoped>
.c-breadcrumb__divider {
  @apply opacity-25;
}

.c-breadcrumb__item {
  @apply text-xs text-surface-700 dark:text-surface-300;

  &--active {
    @apply text-xs font-bold text-surface-900 dark:text-surface-100;
  }

  &:hover {
    @apply text-primary-400;
  }
}
</style>
