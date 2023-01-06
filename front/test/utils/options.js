export default {
  mocks: {
    $axios: {
      $get: jest.fn(() => { return { data: [] } }),
      $post: jest.fn(() => Promise.resolve()),
    },
    $router: {
      push: jest.fn(),
    },
  },
  stubs: ['faIcon', 'Treeselect', 'HomeButton', 'Game'],
}
