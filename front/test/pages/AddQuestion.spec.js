import { mount } from '@vue/test-utils'
import Questions from '@/pages/create/index'
import options from '../utils/options'

describe('Create', () => {
  test('is a Vue instance', () => {
    const wrapper = mount(Questions, options)
    expect(wrapper.vm).toBeTruthy()
  })

  test('is rendered correctly', () => {
    const wrapper = mount(Questions, options)
    expect(wrapper.element).toMatchSnapshot()
  })

  test('question name is null by default', () => {
    const wrapper = mount(Questions, options)
    expect(wrapper.vm.question.name).toBeNull()
  })

  test('themeId is null by default', () => {
    const wrapper = mount(Questions, options)
    expect(wrapper.vm.question.themeId).toBeNull()
  })

  test('difficulty is null by default', () => {
    const wrapper = mount(Questions, options)
    expect(wrapper.vm.question.difficulty).toBeNull()
  })

  test('answers is not null by default', () => {
    const wrapper = mount(Questions, options)
    expect(wrapper.vm.question.answers).not.toBeNull()
  })

  test('answers length is 4', () => {
    const wrapper = mount(Questions, options)
    expect(wrapper.vm.question.answers).toHaveLength(4)
  })

  test('answers has a specific structure', () => {
    const wrapper = mount(Questions, options)
    for (let i = 0; i < 4; i++) {
      expect(wrapper.vm.question.answers[i]).toHaveProperty('name')
      expect(wrapper.vm.question.answers[i].name).toBeNull()
      expect(wrapper.vm.question.answers[i]).toHaveProperty('is_correct')
      expect(wrapper.vm.question.answers[i].is_correct).toBeFalsy()
    }
  })

  test('theme name is null by default', () => {
    const wrapper = mount(Questions, options)
    expect(wrapper.vm.theme.name).toBeNull()
  })

  test('themes is null by default', () => {
    const wrapper = mount(Questions, options)
    expect(wrapper.vm.themes).toBeNull()
  })

  test('a select component is present', () => {
    const wrapper = mount(Questions, options)
    expect(wrapper.find('select').exists()).toBeTruthy()
  })

  test('select component has 3 options', () => {
    const wrapper = mount(Questions, options)
    expect(wrapper.findAll('option')).toHaveLength(3)
  })

  // Test all inputs with their ids
  test('input with id "question" is present', () => {
    const wrapper = mount(Questions, options)
    expect(wrapper.find('#question').exists()).toBeTruthy()
  })

  test('input with id "theme_name" is not present by default', () => {
    const wrapper = mount(Questions, options)
    expect(wrapper.find('#theme_name').exists()).toBeFalsy()
  })

  test('button exists', () => {
    const wrapper = mount(Questions, options)
    expect(wrapper.find('button').exists()).toBeTruthy()
  })

  test('createQuestion is called', () => {
    const wrapper = mount(Questions, options)
    wrapper.vm.createQuestion = jest.fn()
    wrapper.find('button').trigger('click')
    expect(wrapper.vm.createQuestion).toHaveBeenCalled()
  })
})
