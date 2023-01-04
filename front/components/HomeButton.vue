<template>
  <div class="w-1/3">
    <div
      class="
        flex
        items-center
        justify-center
        text-blue text-xl
        hover:bg-gray-200
        rounded-lg
        cursor-pointer
        w-12
        h-12
      "
      @click="$router.push('/')"
    >
      <fa-icon :icon="['fas', 'house']" />
    </div>
  </div>
</template>