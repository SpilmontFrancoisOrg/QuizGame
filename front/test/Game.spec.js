import { mount } from '@vue/test-utils'
import Game from '@/pages/game/index'
import options from './options'

describe('Game', () => {

  test('is a Vue instance', () => {
    const wrapper = mount(Game, options)
    expect(wrapper.vm).toBeTruthy()
  })

  test('is rendered', () => {
    const wrapper = mount(Game, options)
    expect(wrapper.element).toMatchSnapshot()
  })

  test('is not started', () => {
    const wrapper = mount(Game, options)
    expect(wrapper.vm.started).toBeFalsy()
  })

  test('name is null', () => {
    const wrapper = mount(Game, options)
    expect(wrapper.vm.name).toBeNull()
  })

  test('number is 1', () => {
    const wrapper = mount(Game, options)
    expect(wrapper.vm.number).toBe(1)
  })

  test('difficulty is 1', () => {
    const wrapper = mount(Game, options)
    expect(wrapper.vm.difficulty).toBe(1)
  })

  test('currentGame is null', () => {
    const wrapper = mount(Game, options)
    expect(wrapper.vm.currentGame).toBeNull()
  })

  test('timer is 0', () => {
    const wrapper = mount(Game, options)
    expect(wrapper.vm.timer).toBe(0)
  })

  test('is a button', () => {
    const wrapper = mount(Game, options)
    expect(wrapper.find('button').exists()).toBeTruthy()
  })

})
