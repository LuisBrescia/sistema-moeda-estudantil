<script setup>
import { ref } from 'vue';
import { useUsuarioStore } from '@/stores/usuarioStore';
import { useBreadcrumbStore } from '@/stores/breadcrumbStore';
import { useUnidadeStore } from '@/stores/unidadeStore';
import { useToast } from 'primevue/usetoast';

definePageMeta({
  layout: 'aluno',
  middleware: ['authenticated'],
});

const usuarioStore = useUsuarioStore();
const unidadeStore = useUnidadeStore();
const breadcrumbStore = useBreadcrumbStore();

const toast = useToast();

breadcrumbStore.setBreadcrumb([{ name: 'Loja', to: '/home/loja' }]);

const products = ref([
  {
    name: 'Tênis Esportivo',
    image:
      'data:image/jpeg;base64,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',
    category: 'Roupas e Calçados',
    description:
      'Tênis esportivo de alta performance, ideal para corridas e treinos intensivos.',
    price: 500,
    inventoryStatus: 'INSTOCK',
  },
  {
    name: 'Camiseta Confortável',
    image:
      'https://loja.comerciomix.com.br/media/catalog/product/cache/fb4f878514d02efd710032ded901d118/c/a/camiseta-azul-royal-para-sublima_o-tradicional_1.jpg',
    category: 'Roupas',
    description:
      'Camiseta macia e confortável, perfeita para o dia a dia. Disponível em várias cores.',
    price: 300,
    inventoryStatus: 'LOWSTOCK',
  },
  {
    name: 'Relógio Digital',
    image:
      'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQb4VV2O76EWiO5M3gEqYa-Td5kHpzMiaGsZw&s',
    category: 'Acessórios',
    description:
      "Relógio digital moderno, à prova d'água e com várias funções como cronômetro e alarme.",
    price: 1000,
    inventoryStatus: 'OUTOFSTOCK',
  },
  {
    name: 'Mochila de Viagem',
    image:
      'https://kipling.vtexassets.com/arquivos/ids/191842/KPKI5140Z65_1.jpg?v=638070602365370000',
    category: 'Acessórios',
    description:
      'Mochila resistente com amplo espaço e compartimentos para organização. Ideal para viagens longas.',
    price: 750,
    inventoryStatus: 'INSTOCK',
  },
]);

const canBuy = (product) => {
  return usuarioStore.user.saldo >= product.price;
};

const comprarProduto = async (product) => {
  if (canBuy(product)) {
    const res = await useApiRequest(`/aluno/comprar`, {
      method: 'PUT',
      body: {
        product_id: product.id,
        valor: product.price,
        nome: product.name,
      },
    });

    usuarioStore.setSaldo(usuarioStore.user.saldo - product.price);
    toast.add({
      severity: 'success',
      summary: 'Compra realizada',
      detail: `Você gastou ${product.price} pontos. Saldo restante: ${usuarioStore.user.saldo}`,
      life: 3000,
    });
  } else {
    toast.add({
      severity: 'error',
      summary: 'Erro na compra',
      detail: 'Você não tem pontos suficientes para comprar este produto.',
      life: 3000,
    });
  }
};

const getSeverity = (product) => {
  switch (product.inventoryStatus) {
    case 'INSTOCK':
      return 'success';
    case 'LOWSTOCK':
      return 'warn';
    case 'OUTOFSTOCK':
      return 'danger';
    default:
      return null;
  }
};
</script>

<template>
  <div class="px-6 py-8 md:px-12 lg:px-20">
    <div
      class="mt-8 grid grid-cols-1 place-items-center gap-4 lg:grid-cols-2 xl:grid-cols-4"
    >
      <Card
        v-for="(item, index) in products"
        :key="index"
        :style="{
          width: '100%',
          minWidth: '15rem',
          overflow: 'hidden',
        }"
        class="border border-surface-300 dark:border-surface-700"
      >
        <template #header>
          <img
            :alt="item.name"
            :src="item.image"
            class="aspect-square h-64 w-full object-cover"
          />
        </template>
        <template #title>{{ item.name }}</template>
        <template #subtitle>{{ item.category }}</template>
        <template #content>
          <p class="mb-4 text-sm">{{ item.description }}</p>
          <p class="mb-8 text-xl font-semibold">{{ item.price }} pontos</p>
        </template>
        <template #footer>
          <Button
            label="Comprar"
            class="w-full"
            @click="comprarProduto(item)"
          />
        </template>
      </Card>
    </div>
  </div>
</template>

<style scoped>
body,
html {
  height: 100%;
  margin: 0;
  display: flex;
  flex-direction: column;
}

main {
  flex-grow: 1;
  overflow-y: auto;
}

.card {
  margin-top: 20px;
}
</style>
