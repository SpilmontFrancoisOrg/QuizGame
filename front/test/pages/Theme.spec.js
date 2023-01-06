import { mount } from '@vue/test-utils'
import Index from '@/pages/index'
import options from '../utils/options'

describe('Themes', () => {

  test('is a Vue instance', () => {
    const wrapper = mount(Index, options)
    expect(wrapper.vm).toBeTruthy()
  })

  test('is rendered correctly', () => {
    const wrapper = mount(Index, options)
    expect(wrapper.element).toMatchSnapshot()
  })

  test('themes is null by default', () => {
    const wrapper = mount(Index, options)
    expect(wrapper.vm.themes).toBeNull()
  })

  test('loaded is false by default', () => {
    const wrapper = mount(Index, options)
    expect(wrapper.vm.loaded).toBeFalsy()
  })

  test('themes is an array after calling method', () => {
    const wrapper = mount(Index, options)
    wrapper.vm.getThemes()
      .then(() => {
        expect(wrapper.vm.themes).toBeInstanceOf(Array)
      })
  })

  test('loaded is true after calling method', () => {
    const wrapper = mount(Index, options)
    wrapper.vm.getThemes()
      .then(() => {
        expect(wrapper.vm.loaded).toBeTruthy()
      })
  })

  test('a button exists', () => {
    const wrapper = mount(Index, options)
    expect(wrapper.find('button').exists()).toBeTruthy()
  })

  test('the button redirects to "/create" on click', () => {
    const wrapper = mount(Index, options)
    wrapper.find('button').trigger('click')
    expect(wrapper.vm.$router.push).toHaveBeenCalledWith('/create')
  })

})
