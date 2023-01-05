import { mount } from '@vue/test-utils'
import Leaderboard from '@/pages/leaderboard/index'
import options from './options'

describe('Leaderbord', () => {

  test('is a Vue instance', () => {
    const wrapper = mount(Leaderboard, options)
    expect(wrapper.vm).toBeTruthy()
  })

  test('is rendered', () => {
    const wrapper = mount(Leaderboard, options)
    expect(wrapper.element).toMatchSnapshot()
  })

  test('is null', () => {
    const wrapper = mount(Leaderboard, options)
    expect(wrapper.vm.players).toBeNull()
  })

  test('is not null', () => {
    const wrapper = mount(Leaderboard, options)
    wrapper.vm.getPlayers()
      .then(() => {
        expect(wrapper.vm.players).not.toBeNull()
      })
  })

})
