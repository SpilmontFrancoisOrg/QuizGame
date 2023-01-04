<template>
  <div>
    <div v-for="theme in themes" :key="theme.id" class="card cursor-pointer" @click="chooseTheme(theme.id)">
      <span>{{ theme.name }}</span>
      <img :src="theme.image" />
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      themes: null,
    }
  },
  mounted() {
    this.getThemes()
  },
  methods: {
    async getThemes() {
      const { data } = await this.$axios.$get('/api/themes')
      this.themes = data
    },
    chooseTheme(id) {
      this.$router.push(`/game?theme=${id}`)
    },
  },
}
</script>