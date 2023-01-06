import { mount } from '@vue/test-utils'
import HomeButton from '@/components/HomeButton'
import options from '../utils/options'

describe('HomeButton', () => {
  test('is a Vue instance', () => {
    const wrapper = mount(HomeButton, options)
    expect(wrapper.vm).toBeTruthy()
  })

  test('is rendered correctly', () => {
    const wrapper = mount(HomeButton, options)
    expect(wrapper.element).toMatchSnapshot()
  })

  test('button redirect correctly', () => {
    const wrapper = mount(HomeButton, options)
    wrapper.find('.h-12').trigger('click')
    expect(wrapper.vm.$router.push).toHaveBeenCalledWith('/')
  })
})
