<template>
  <div class="space-y-6">
    <div class="card flex-row justify-between p-4">
      <button class="btn-primary" @click="$router.push('/')">Home</button>
      <span class="text-2xl font-semibold">Leaderboard</span>
      <div />
    </div>

    <!-- Show leaderboard in a table -->
    <div class="card p-4">
      <table
        class="table-auto w-1/3 border-separate border border-text rounded-xl"
      >
        <thead>
          <tr>
            <th class="border-r border-b border-text px-4 py-2 font-semibold">
              Nom
            </th>
            <th class="border-b border-text px-4 py-2 font-semibold">Score</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="player in players" :key="player.id">
            <td class="border-r border-b border-text px-4 py-2">
              {{ player.name }}
            </td>
            <td class="border-b border-text px-4 py-2">{{ player.score }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      players: null,
    }
  },
  mounted() {
    this.getPlayers()
  },
  methods: {
    async getPlayers() {
      const { data } = await this.$axios.$get('/api/games/leaderboard')
      this.players = data
    },
  },
}
</script>