import { mount } from '@vue/test-utils'
import Game from '@/pages/game/index'
import options from '../utils/options'

describe('Game', () => {
  test('is a Vue instance', () => {
    const wrapper = mount(Game, options)
    expect(wrapper.vm).toBeTruthy()
  })

  test('is rendered correctly', () => {
    const wrapper = mount(Game, options)
    expect(wrapper.element).toMatchSnapshot()
  })

  test('game is not started by default', () => {
    const wrapper = mount(Game, options)
    expect(wrapper.vm.started).toBeFalsy()
  })

  test('name is null by default', () => {
    const wrapper = mount(Game, options)
    expect(wrapper.vm.name).toBeNull()
  })

  test('number of questions is 1 by default', () => {
    const wrapper = mount(Game, options)
    expect(wrapper.vm.number).toBe(1)
  })

  test('difficulty is 1 by default', () => {
    const wrapper = mount(Game, options)
    expect(wrapper.vm.difficulty).toBe(1)
  })

  test('currentGame is null by default', () => {
    const wrapper = mount(Game, options)
    expect(wrapper.vm.currentGame).toBeNull()
  })

  test('timer is 0 by default', () => {
    const wrapper = mount(Game, options)
    expect(wrapper.vm.timer).toBe(0)
  })

  test('button with text "Jouer !" is present', () => {
    const wrapper = mount(Game, options)
    expect(wrapper.find('button').text()).toBe('Jouer !')
  })
})
