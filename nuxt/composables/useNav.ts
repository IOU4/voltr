interface NavItems {
  notification: boolean,
  profile: boolean,
  nav: boolean,
  setMenu: (prop?: string) => void;
}

export const useNav = function() {
  return useState<NavItems>('nav', function() {
    return {
      notification: false,
      profile: false,
      nav: false,
      setMenu(prop) {
        for (const key in this)
          if (typeof this[key] != 'function') this[key] = false
        if (prop && prop in this) this[prop] = true
      }
    }
  })
}
