<template>
  <div class="space-y-6">
    <div class="card flex-row justify-between p-6">
      <span class="text-2xl font-semibold w-1/3">Partie en cours</span>

      <div class="flex justify-center text-xl font-semibold space-x-2 w-1/3">
        <span>Score : {{ score }}</span>
        <span v-if="hasAnswered && answerIsCorrect" class="text-green">
          +1
        </span>
      </div>

      <span class="flex justify-end text-xl font-semibold w-1/3">
        Question {{ currentQuestion + 1 }} sur
        {{ game.questions.length }}
      </span>
    </div>

    <div class="card p-4">
      <div class="flex flex-col space-y-6">
        <span class="text-xl font-semibold text-center">
          {{ game.questions[currentQuestion].question.name }}
        </span>

        <div class="grid grid-cols-2 gap-4">
          <button
            v-for="(answer, index) in game.questions[currentQuestion].answers"
            :key="index"
            class="btn-primary"
            :class="{
              'btn-success': hasAnswered && answer.is_correct,
              'btn-danger': hasAnswered && !answer.is_correct,
            }"
            :disabled="hasAnswered"
            @click="checkAnswer(answer)"
          >
            {{ answer.name }}
          </button>
        </div>

        <button
          v-if="hasAnswered && currentQuestion < game.questions.length - 1"
          class="btn-secondary"
          @click="nextQuestion()"
        >
          Question suivante
        </button>
        <div
          v-else-if="
            hasAnswered && currentQuestion === game.questions.length - 1
          "
          class="flex space-x-4"
        >
          <button class="btn-secondary" @click="showLeaderboard()">
            Voir le leaderboard
          </button>
          <button class="btn-warning" @click="endGame()">
            Fin de la partie
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'GameComponent',
  props: {
    game: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      currentQuestion: 0,
      score: 0,
      hasAnswered: false,
      answerIsCorrect: false,
    }
  },
  methods: {
    checkAnswer(answer) {
      this.hasAnswered = true
      if (answer.is_correct) {
        this.score++
        this.answerIsCorrect = true
        setTimeout(() => {
          this.answerIsCorrect = false
        }, 1000)
      }
    },
    nextQuestion() {
      this.hasAnswered = false
      if (this.currentQuestion < this.game.questions.length - 1)
        this.currentQuestion++
    },
    endGame() {
      this.$emit('endGame', this.score)
    },
    showLeaderboard() {
      this.$router.push('/leaderboard')
    },
  },
}
</script>