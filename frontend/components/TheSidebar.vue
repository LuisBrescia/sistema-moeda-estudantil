<script setup>
import { User, Medal, Gem } from 'lucide-vue-next';
import { useViewWrapperStore } from '@/stores/viewWrapperStore';

const route = useRoute();
const viewWrapperStore = useViewWrapperStore();
const nextChangeIcon = {
  'pi-arrow-left': 'pi-arrow-right',
  'pi-arrow-right': 'pi-arrow-left',
};
const panelStatusIcon = ref();
panelStatusIcon.value = viewWrapperStore.sidebarOpen
  ? 'pi-arrow-left'
  : 'pi-arrow-right';
const handlePanelChange = () => {
  panelStatusIcon.value = nextChangeIcon[panelStatusIcon.value];
  viewWrapperStore.toggleSidebar();
};

const itemsSidebar = [
  // * Seção geral
  [
    {
      icon: User,
      label: 'Meu perfil',
      to: '/home',
    },
    {
      icon: Medal,
      label: 'Pódio',
      to: '/home/podio',
    },
    {
      icon: Gem,
      label: 'Vantagens',
      to: '/home/vantagens',
    },
  ],
  [],
];
</script>

<template>
  <aside class="c-sidebar" :class="{ 'is-open': viewWrapperStore.sidebarOpen }">
    <div class="c-sidebar__header">
      <h2 class="c-sidebar__header__branding">
        <IconReceiptJapaneseYen class="text-primary-500" :size="20" />
        <span class="text-base">Syscoin</span>
      </h2>

      <div class="c-sidebar__header__panel-switch">
        <Button
          class="rounded-custom p-1"
          text
          severity="secondary"
          size="small"
          @click="handlePanelChange"
        >
          <IconPanelLeftClose
            v-if="panelStatusIcon === 'pi-arrow-left'"
            :stroke-width="1.5"
            :size="20"
          />
          <IconPanelLeftOpen v-else :stroke-width="1.5" :size="20" />
        </Button>
      </div>
    </div>

    <div class="c-sidebar__body">
      <h4 class="c-sidebar__body__header mb-2 px-4">Gerais</h4>

      <template v-for="item in itemsSidebar[0]" :key="item">
        <NuxtLink :to="item.to">
          <div class="c-sidebar__item px-4 py-2">
            <component :is="item.icon" :size="16" />
            <span class="ml-2 text-nowrap">{{ item.label }}</span>
          </div>
        </NuxtLink>
      </template>

      <div class="my-2 h-[1px] bg-surface-300 dark:bg-surface-700" />
    </div>

    <div class="c-sidebar__item p-4">
      <IconHelpCircle :size="16" />
      <span class="ml-2">Ajuda</span>
    </div>
  </aside>
</template>

<style lang="scss" scoped>
.c-sidebar {
  @apply flex flex-col border-r border-surface-300 bg-surface-0 text-xs dark:border-surface-700 dark:bg-surface-900;

  width: 48px;
  transition: width 0.3s ease-in-out;
  overflow: hidden;
  position: sticky;
  top: 0;
  max-height: 100vh;

  &__header {
    @apply flex justify-between px-4 py-2;
    position: relative;

    &__branding {
      @apply flex items-center gap-1 font-black;
      position: relative;
      top: 2px;
      text-wrap: nowrap;
      opacity: 0;
      transition: opacity 0.3s ease-in-out;
    }

    &__panel-switch {
      position: absolute;
      top: 8px;
      right: 8px;
    }
  }

  &__body {
    @apply flex-1 py-4;
    &__header {
      @apply text-nowrap;
      opacity: 0;
      height: 0;
      transition:
        opacity 0.3s ease-in-out,
        height 0.3s ease-in-out;
    }
  }

  &__item {
    @apply flex cursor-pointer items-center text-xs hover:bg-surface-100 active:bg-surface-200 dark:hover:bg-surface-800 dark:active:bg-surface-700;
    position: relative;

    & svg {
      @apply opacity-75;
      position: absolute;
    }
    & span {
      @apply ml-8;
      opacity: 0;
      transition: opacity 0.3s ease-in-out;
    }
  }

  &.is-open {
    width: 18rem;

    .c-sidebar__header {
      &__branding {
        opacity: 1;
      }
    }

    .c-sidebar__body {
      &__header {
        @apply font-semibold;
        opacity: 1;
        height: 1rem;
      }
    }

    .c-sidebar__item {
      & span {
        opacity: 1;
      }
    }
  }
}

.router-link-active .c-sidebar__item,
.c-sidebar__item.is-active,
.router-link-active:hover .c-sidebar__item {
  @apply bg-primary-200 text-surface-900 outline-primary-500 dark:bg-primary-700 dark:text-surface-0;
  box-shadow: inset 4px 0 0 0 #f97316;

  svg {
    @apply opacity-100;
  }
}
</style>
