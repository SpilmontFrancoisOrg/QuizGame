import { mount } from '@vue/test-utils'
import Leaderboard from '@/pages/leaderboard/index'
import options from '../utils/options'

describe('Leaderbord', () => {
  test('is a Vue instance', () => {
    const wrapper = mount(Leaderboard, options)
    expect(wrapper.vm).toBeTruthy()
  })

  test('is rendered correctly', () => {
    const wrapper = mount(Leaderboard, options)
    expect(wrapper.element).toMatchSnapshot()
  })

  test('players is null by default', () => {
    const wrapper = mount(Leaderboard, options)
    expect(wrapper.vm.players).toBeNull()
  })

  test('is an array after calling method', () => {
    const wrapper = mount(Leaderboard, options)
    wrapper.vm.getPlayers().then(() => {
      expect(wrapper.vm.players).toBeInstanceOf(Array)
    })
  })
})
