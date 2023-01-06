import { mount } from '@vue/test-utils'
import GameComponent from '@/components/Game'
import options from '../utils/options'

describe('GameComponent', () => {
  beforeEach(() => {
    options.propsData = {
      game: {
        game: {
          id: 1,
          name: 'Player 1',
          score: null,
          date: '2023-01-06',
          time: null,
        },
        questions: [
          {
            question: {
              id: 1,
              name: 'Combien de joueurs dans une équipe de football ?',
              theme_id: 1,
              difficulty: 1,
            },
            answers: [
              {
                id: 1,
                name: '11',
                is_correct: 1,
              },
              {
                id: 2,
                name: '10',
                is_correct: 0,
              },
              {
                id: 3,
                name: '9',
                is_correct: 0,
              },
              {
                id: 4,
                name: '8',
                is_correct: 0,
              },
            ],
          },
        ],
      },
    }
  })

  test('is a Vue instance', () => {
    const wrapper = mount(GameComponent, options)
    expect(wrapper.vm).toBeTruthy()
  })

  test('is rendered correctly', () => {
    const wrapper = mount(GameComponent, options)
    expect(wrapper.element).toMatchSnapshot()
  })
})
