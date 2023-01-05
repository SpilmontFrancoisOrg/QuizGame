import { mount, shallowMount } from '@vue/test-utils'
import Index from '@/pages/index'
import Game from '@/components/Game'

describe('Test', () => {
  const options = {
    mocks: {
      $axios: {
        $get: jest.fn(),
        $post: jest.fn(() => Promise.resolve()),
      },
      $router: {
        push: jest.fn(),
      },
    },
    stubs: ['faIcon'],
  }

  test('is a Vue instance', () => {
    const wrapper = mount(Index, options)
    expect(wrapper.vm).toBeTruthy()
  })

  test('score is undefined', () => {
    const wrapper = mount(Index, options)
    expect(wrapper.vm.score).toBeUndefined()
  })

  test('score is not defined', () => {
    const wrapper = mount(Index, options)
    expect(wrapper.vm.score).not.toBeDefined()
  })

  test('name is empty', () => {
    const wrapper = mount(Index, options)
    expect(wrapper.vm.name).toBe('')
  })

  test('name length is not > 0', () => {
    const wrapper = mount(Index, options)
    expect(wrapper.vm.name.length).not.toBeGreaterThan(0)
  })

  test('number of questions is 1', () => {
    const wrapper = mount(Index, options)
    expect(wrapper.vm.number).toBe(1)
  })

  test('difficulty is empty', () => {
    const wrapper = mount(Index, options)
    expect(wrapper.vm.difficulty).toBe('')
  })

  test('started is false', () => {
    const wrapper = mount(Index, options)
    expect(wrapper.vm.started).toBe(false)
  })

  test('button "Jouer !" is present', () => {
    const wrapper = mount(Index, options)
    expect(wrapper.find('button').text()).toBe('Jouer !')
  })

  test('startGame is called', () => {
    const wrapper = mount(Index, options)
    wrapper.vm.startGame = jest.fn()
    wrapper.find('button').trigger('click')
    expect(wrapper.vm.startGame).toHaveBeenCalled()
  })
})
