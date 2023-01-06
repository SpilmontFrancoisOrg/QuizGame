<template>
  <div class="space-y-6">
    <div class="card flex-row justify-between p-6">
      <HomeButton />
      <div class="w-1/3 flex items-center justify-center">
        <span class="font-semibold text-2xl">Création</span>
      </div>
      <div class="w-1/3" />
    </div>

    <div class="card flex-row justify-center space-x-10 p-4">
      <div class="flex items-center space-x-2">
        <input
          id="qmode"
          v-model="mode"
          type="radio"
          name="mode"
          value="question"
        />
        <label for="qmode">Créer une question</label>
      </div>
      <div class="flex items-center space-x-2">
        <input
          id="tmode"
          v-model="mode"
          type="radio"
          name="mode"
          value="theme"
        />
        <label for="tmode">Créer un thème</label>
      </div>
    </div>

    <div class="card justify-center space-y-8 p-4">
      <div
        v-if="mode === 'question'"
        class="space-y-4 w-1/3 flex flex-col items-center"
      >
        <div class="flex flex-col space-y-2 w-full">
          <label for="question">Question</label>
          <input id="question" v-model="question.name" type="text" />
        </div>

        <div class="flex flex-col space-y-2 w-full">
          <span>Thème</span>
          <Treeselect
            v-model="question.themeId"
            :multiple="false"
            :options="themes"
          />
        </div>

        <div class="flex flex-col space-y-2 w-full">
          <label for="difficulty">Difficulté</label>
          <select v-model="question.difficulty" name="difficulty">
            <option value="1">Facile</option>
            <option value="2">Moyen</option>
            <option value="3">Difficile</option>
          </select>
        </div>

        <div class="flex flex-col items-center space-y-2 w-full">
          <span for="difficulty">Réponses (Minimum 2 réponses requises)</span>
          <div class="flex flex-col space-y-2">
            <div class="flex items-center space-x-2">
              <input v-model="question.answers[0].name" type="text" />
              <input
                type="radio"
                name="is_correct"
                @click="setCorrectAnswer(0)"
              />
              <span v-if="question.answers[0].is_correct">
                Réponse correcte
              </span>
            </div>
            <div class="flex items-center space-x-2">
              <input v-model="question.answers[1].name" type="text" />
              <input
                type="radio"
                name="is_correct"
                @click="setCorrectAnswer(1)"
              />
              <span v-if="question.answers[1].is_correct">
                Réponse correcte
              </span>
            </div>
            <div class="flex items-center space-x-2">
              <input v-model="question.answers[2].name" type="text" />
              <input
                type="radio"
                name="is_correct"
                @click="setCorrectAnswer(2)"
              />
              <span v-if="question.answers[2].is_correct">
                Réponse correcte
              </span>
            </div>
            <div class="flex items-center space-x-2">
              <input v-model="question.answers[3].name" type="text" />
              <input
                type="radio"
                name="is_correct"
                @click="setCorrectAnswer(3)"
              />
              <span v-if="question.answers[3].is_correct">
                Réponse correcte
              </span>
            </div>
          </div>
        </div>
      </div>
      <div v-else class="w-1/3">
        <div class="flex flex-col space-y-2">
          <label for="theme_name">Nom du thème</label>
          <input id="theme_name" v-model="theme.name" type="text" />
        </div>
      </div>

      <button class="btn-primary space-x-2" @click="create()">
        <fa-icon :icon="['fas', 'plus']" />
        <span>Créer</span>
      </button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      mode: 'question',
      question: {
        name: null,
        themeId: null,
        difficulty: null,
        answers: [
          {
            name: null,
            is_correct: false,
          },
          {
            name: null,
            is_correct: false,
          },
          {
            name: null,
            is_correct: false,
          },
          {
            name: null,
            is_correct: false,
          },
        ],
      },
      theme: {
        name: null,
      },
      themes: null,
    }
  },
  watch: {
    mode() {
      this.resetValues()
    },
  },
  mounted() {
    this.fetchThemes()
  },
  methods: {
    async fetchThemes() {
      const { data } = await this.$axios.$get('/api/themes')
      this.themes = data.map((theme) => {
        return {
          id: theme.id,
          label: theme.name,
        }
      })
    },
    create() {
      if (this.mode === 'question') this.createQuestion()
      else this.createTheme()
    },
    async createQuestion() {
      const answs = this.question.answers
        .filter((answer) => answer.name !== null)
        .map((answer) => {
          if (answer.is_correct === null) answer.is_correct = false
          return answer
        })

      if (
        !this.question.name ||
        !this.question.themeId ||
        !this.question.difficulty
      ) {
        const toast = this.$toast.error('Vous devez renseigner tous les champs')
        setTimeout(() => {
          toast.remove()
        }, 5000)
        return
      }

      if (answs.length < 2) {
        const toast = this.$toast.error(
          'Vous devez renseigner au moins 2 réponses'
        )
        setTimeout(() => {
          toast.remove()
        }, 5000)
        return
      }

      if (!answs.some((answer) => answer.is_correct)) {
        const toast = this.$toast.error(
          'Vous devez renseigner une réponse correcte'
        )
        setTimeout(() => {
          toast.remove()
        }, 5000)
        return
      }

      try {
        await this.$axios.$post('/api/questions', {
          name: this.question.name,
          theme_id: this.question.themeId,
          difficulty: this.question.difficulty,
          answers: answs,
        })

        const toast = this.$toast.success('La question a bien été créée !')
        setTimeout(() => {
          toast.remove()
        }, 5000)
      } catch (error) {
        const toast = this.$toast.error(
          'Une erreur est survenue lors de la création de la question'
        )
        setTimeout(() => {
          toast.remove()
        }, 5000)
      } finally {
        this.resetValues()
      }
    },
    async createTheme() {
      if (!this.theme.name) {
        const toast = this.$toast.error('Vous devez renseigner le nom du thème')
        setTimeout(() => {
          toast.remove()
        }, 5000)
        return
      }

      try {
        await this.$axios.$post('/api/themes', {
          name: this.theme.name,
        })

        const toast = this.$toast.success('Le thème a bien été créé !')
        setTimeout(() => {
          toast.remove()
        }, 5000)

        this.fetchThemes()
      } catch (error) {
        const toast = this.$toast.error(
          'Une erreur est survenue lors de la création du thème'
        )
        setTimeout(() => {
          toast.remove()
        }, 5000)
      } finally {
        this.resetValues()
      }
    },
    setCorrectAnswer(index) {
      this.question.answers.forEach((answer, i) => {
        if (i === index) answer.is_correct = true
        else answer.is_correct = false
      })
    },
    resetValues() {
      this.question = {
        name: null,
        themeId: null,
        difficulty: null,
        answers: [
          {
            name: null,
            is_correct: false,
          },
          {
            name: null,
            is_correct: false,
          },
          {
            name: null,
            is_correct: false,
          },
          {
            name: null,
            is_correct: false,
          },
        ],
      }
      this.theme = {
        name: null,
      }
    },
  },
}
</script>