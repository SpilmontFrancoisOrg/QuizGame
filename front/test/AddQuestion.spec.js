import { mount } from '@vue/test-utils'
import Questions from '@/pages/create/index'
import options from './options'

describe('Create', () => {

  test('is a Vue instance', () => {
    const wrapper = mount(Questions, options)
    expect(wrapper.vm).toBeTruthy()
  })

  test('is rendered', () => {
    const wrapper = mount(Questions, options)
    expect(wrapper.element).toMatchSnapshot()
  })

  test('is null', () => {
    const wrapper = mount(Questions, options)
    expect(wrapper.vm.question.name).toBeNull()
  })

  test('is null', () => {
    const wrapper = mount(Questions, options)
    expect(wrapper.vm.question.themeId).toBeNull()
  })

  test('is null', () => {
    const wrapper = mount(Questions, options)
    expect(wrapper.vm.question.difficulty).toBeNull()
  })

  test('is not null', () => {
    const wrapper = mount(Questions, options)
    expect(wrapper.vm.question.answers).not.toBeNull()
  })

  test('is 4', () => {
    const wrapper = mount(Questions, options)
    expect(wrapper.vm.question.answers.length).toBe(4)
  })

  test('is null', () => {
    const wrapper = mount(Questions, options)
    expect(wrapper.vm.theme.name).toBeNull()
  })

  test('is null', () => {
    const wrapper = mount(Questions, options)
    expect(wrapper.vm.themes).toBeNull()
  })

  test('is a select', () => {
    const wrapper = mount(Questions, options)
    expect(wrapper.find('select').exists()).toBeTruthy()
  })

  test('input exist', () => {
    const wrapper = mount(Questions, options)
    expect(wrapper.find('input').exists()).toBeTruthy()
  })

  test('is a button', () => {
    const wrapper = mount(Questions, options)
    expect(wrapper.find('button').exists()).toBeTruthy()
  })

  test('is called', () => {
    const wrapper = mount(Questions, options)
    wrapper.vm.createQuestion = jest.fn()
    wrapper.find('button').trigger('click')
    expect(wrapper.vm.createQuestion).toHaveBeenCalled()
  })

})
