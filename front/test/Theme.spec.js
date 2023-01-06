import { mount } from '@vue/test-utils'
import Index from '@/pages/index'
import options from './options'

describe('Themes', () => {

  test('is a Vue instance', () => {
    const wrapper = mount(Index, options)
    expect(wrapper.vm).toBeTruthy()
  })

  test('is rendered', () => {
    const wrapper = mount(Index, options)
    expect(wrapper.element).toMatchSnapshot()
  })

  test('is null', () => {
    const wrapper = mount(Index, options)
    expect(wrapper.vm.themes).toBeNull()
  })

  test('is false', () => {
    const wrapper = mount(Index, options)
    expect(wrapper.vm.loaded).toBeFalsy()
  })

  test('is an array', () => {
    const wrapper = mount(Index, options)
    wrapper.vm.getThemes()
      .then(() => {
        expect(wrapper.vm.themes).toBeInstanceOf(Array)
      })
  })

  test('is true', () => {
    const wrapper = mount(Index, options)
    wrapper.vm.getThemes()
      .then(() => {
        expect(wrapper.vm.loaded).toBeTruthy()
      })
  })

  test('is a button', () => {
    const wrapper = mount(Index, options)
    expect(wrapper.find('button').exists()).toBeTruthy()
  })

  test('is a button works', () => {
    const wrapper = mount(Index, options)
    wrapper.find('button').trigger('click')
    expect(wrapper.vm.$router.push).toHaveBeenCalled()
  })

})
