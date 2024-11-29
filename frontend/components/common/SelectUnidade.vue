<script setup lang="ts">
import type { Pagination } from '@/types/common/Pagination';
import type { Unidade } from '@/types/Unidade';
import UnidadeService from '@/services/UnidadeService';
import { useUnidadeStore } from '@/stores/unidadeStore';

const unidadeStore = useUnidadeStore();
const unidadesData = ref<Unidade[]>([]);
const unidadePagination = ref<Pagination>({
  current_page: 1,
  last_page: 1,
  per_page: 10,
  total: 0,
});

const getUnidadesLoading = ref<boolean>(false);
const getUnidades = async (page = 1) => {
  getUnidadesLoading.value = true;
  try {
    const res = await UnidadeService.getAll({
      page: page,
    });
    unidadesData.value = res.data;
    unidadePagination.value = res.meta;
  } catch (error) {
    console.error(error);
  } finally {
    getUnidadesLoading.value = false;
  }
};

const handlePaginate = (page: number): void => {
  const balance = unidadePagination.value.current_page + page;
  if (balance < 1 || balance > unidadePagination.value.last_page) return;
  getUnidades(balance);
};

const selectUnidadePopover = ref();

const handleSelectUnidadePopover = (event: Event): void => {
  selectUnidadePopover.value.toggle(event);
};

const handleSelectUnidade = (unidade: Unidade): void => {
  unidadeStore.setUnidade(unidade);
  // selectUnidadePopover.value.hide();
};

onMounted(() => {
  getUnidades();
});
</script>

<template>
  <div
    class="c-sidebar__body__select-unidade"
    @click="handleSelectUnidadePopover"
  >
    <div class="c-sidebar__body__select-unidade__leading">
      <!-- <div class="branding-square custom-background w-8" /> -->
      <AppAvatar
        :letra="unidadeStore.unidade?.nome_fantasia[0]"
        shape="square"
        size="large"
      />
      <div class="c-sidebar__body__select-unidade__leading__info">
        <span
          v-if="unidadeStore.unidade"
          class="c-sidebar__body__select-unidade__leading__info__id"
        >
          #{{ unidadeStore.unidade.id }}
        </span>
        <h5 class="c-sidebar__body__select-unidade__leading__info__name">
          {{
            unidadeStore.unidade
              ? unidadeStore.unidade.nome_fantasia
              : 'Selecione uma unidade'
          }}
        </h5>
      </div>
    </div>

    <IconChevronsUpDown />
  </div>

  <Popover
    ref="selectUnidadePopover"
    unstyled
    class="mt-2 w-[17rem] rounded border border-surface-300 bg-surface-0 py-2 shadow-lg dark:border-surface-700 dark:bg-surface-900"
  >
    <div class="ms-auto flex items-center justify-between gap-2 p-2">
      <div class="text-xs">
        Página {{ unidadePagination.current_page }} de
        {{ unidadePagination.last_page }}
      </div>
      <div class="flex">
        <span
          class="c-select-unidade-popper__pagination-arrow"
          :class="{ disabled: unidadePagination.current_page === 1 }"
          @click="handlePaginate(-1)"
        >
          <IconChevronLeft :size="16" />
        </span>

        <span
          class="c-select-unidade-popper__pagination-arrow"
          :class="{
            disabled:
              unidadePagination.current_page === unidadePagination.last_page,
          }"
          @click="handlePaginate(1)"
        >
          <IconChevronRight :size="16" />
        </span>
      </div>
    </div>

    <div
      class="c-select-unidade-popper__item interativo"
      :class="{ 'is-active': unidade.id === unidadeStore.unidade?.id }"
      v-for="unidade in unidadesData"
      @click="handleSelectUnidade(unidade)"
    >
      <div class="flex items-center gap-2">
        <!-- > TODO: aqui não está pegando por foto ainda -->
        <AppAvatar :letra="unidade.nome_fantasia[0]" shape="square" />
        <span class="text-xs">
          {{ unidade.nome_fantasia }}
        </span>
      </div>
      <span v-if="unidade.id === unidadeStore.unidade?.id">
        <IconCheckCheck :size="16" color="#f97316" />
      </span>
    </div>

    <div class="my-2 h-[1px] w-full bg-surface-200 dark:bg-surface-800" />

    <div
      class="flex cursor-pointer items-center justify-between p-2 text-surface-900 hover:bg-primary-200 dark:text-surface-0 dark:hover:bg-primary-700"
      @click="navigateTo('/admin/home/unidades/adicionar')"
    >
      <div class="flex items-center gap-2">
        <IconPlus :size="16" class="opacity-75" />
        <span class="text-xs">Criar nova unidade</span>
      </div>
    </div>
  </Popover>
</template>

<style lang="scss" scoped>
.c-sidebar {
  &__body__select-unidade {
    @apply flex cursor-pointer items-center justify-between rounded outline-2 outline-primary-main hover:outline;
    margin: 0 0.5rem;
    margin-bottom: 0.5rem;
    transition:
      padding 0.3s ease-in-out,
      background-color 0.3s ease-in-out,
      margin 0.3s ease-in-out;

    &__leading {
      @apply flex items-center gap-2;

      &__info {
        @apply flex flex-col;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;

        &__id {
          @apply text-surface-500;
        }

        &__name {
          @apply text-nowrap text-surface-900 dark:text-surface-100;
        }
      }
    }
  }
  &.is-open {
    .c-sidebar__body__select-unidade {
      @apply bg-surface-100 p-2 dark:bg-surface-800;

      &__leading {
        &__info {
          opacity: 1;
        }
      }
    }
  }
}

.c-select-unidade-popper {
  &__pagination-arrow {
    @apply cursor-pointer border-surface-300 dark:border-surface-700;
    transition: background-color 0.3s ease-in-out;

    &:not(.disabled) {
      @apply hover:text-primary-main;
    }

    &.disabled {
      @apply opacity-50;
    }
  }

  &__item {
    @apply flex cursor-pointer items-center justify-between p-2;
    &.is-active {
      @apply bg-primary-200 text-surface-900 outline-primary-main dark:bg-primary-700 dark:text-surface-0;
      box-shadow: inset 4px 0 0 0 #f97316;
    }
  }
}

.branding-square {
  @apply aspect-square rounded;
}

.custom-background {
  background: linear-gradient(144deg, #c6ffdd, #fbd786, #f64f59);
}
</style>
