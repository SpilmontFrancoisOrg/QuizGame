<template>
  <div class="space-y-6">
    <div class="card flex-row justify-between p-6">
      <HomeButton />
      <div
        class="
          flex
          items-center
          justify-center
          text-2xl
          font-semibold
          space-x-4
          w-1/3
        "
      >
        <fa-icon :icon="['fas', 'trophy']" class="text-yellow-400" />
        <span>Leaderboard</span>
        <fa-icon :icon="['fas', 'trophy']" class="text-yellow-400" />
      </div>
      <div class="w-1/3" />
    </div>

    <!-- Show leaderboard in a table -->
    <div class="card p-4">
      <table
        class="table-auto w-1/3 border-separate border border-text rounded-xl"
      >
        <caption />
        <thead>
          <tr>
            <th class="border-b border-text px-4 py-2 font-semibold">Nom</th>
            <th class="border-b border-x border-text px-4 py-2 font-semibold">
              Temps
            </th>
            <th class="border-b border-r border-text px-4 py-2 font-semibold">
              Score
            </th>
            <th class="border-b border-text px-4 py-2 font-semibold">Date</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="player in players" :key="player.id">
            <td class="border-b border-text px-4 py-2">
              {{ player.name }}
            </td>
            <td class="border-b border-x border-text px-4 py-2">
              {{ player.time }} s
            </td>
            <td class="border-b border-r border-text px-4 py-2">
              {{ player.score }}
            </td>
            <td class="border-b border-text px-4 py-2">{{ player.date }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import moment from 'moment'

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
      this.players.map((player) => {
        player.date = moment(player.date).format('DD/MM/YYYY')
        return player
      })
    },
  },
}
</script>