export const useCount = () => useState<number>('counter', () => Math.round(Math.random() * 100))
export const useOtherCount = () => useState<number>('otherCount', () => Math.round(Math.random() * 100))
export const useApiUrl = () => {
  const config = useRuntimeConfig()
  return config.public.apiBase
}

export const useImgsUrl = () => {
  const config = useRuntimeConfig()
  return config.public.imgsBase
}
