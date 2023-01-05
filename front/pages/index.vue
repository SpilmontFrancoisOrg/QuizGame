<template>
  <div class="space-y-6">
    <div class="card flex-row justify-between p-6">
      <div class="w-1/3">
        <img src="@/assets/logo.png" alt="logo" class="h-16 w-16" />
      </div>
      <div class="w-1/3 flex items-center justify-center">
        <span class="font-semibold text-2xl">Choisissez le thème</span>
      </div>
      <div class="w-1/3" />
    </div>

    <div v-if="loaded" class="flex flex-wrap">
      <div
        v-for="theme in themes"
        :key="theme.id"
        class="
          card
          justify-center
          cursor-pointer
          w-[200px]
          h-32
          bg-no-repeat bg-center
          m-10
        "
        :style="{ backgroundImage: 'url(' + theme.image + ')' }"
        @click="chooseTheme(theme.id)"
      >
        <span
          class="bg-white opacity-80 rounded-full px-2 py-1 text-xl font-bold"
        >
          {{ theme.name }}
        </span>
      </div>
    </div>
    <div v-else>
      <div class="card flex-row justify-center space-x-4 p-4">
        <fa-icon :icon="['fas', 'spinner']" class="animate-spin text-blue" />
        <span class="text-xl font-semibold">Chargement...</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      themes: null,
      loaded: false,
    }
  },
  mounted() {
    this.getThemes()
  },
  methods: {
    async getThemes() {
      const { data } = await this.$axios.$get('/api/themes')
      this.themes = data
      this.loaded = true
    },
    chooseTheme(id) {
      this.$router.push(`/game?theme=${id}`)
    },
  },
}
</script>