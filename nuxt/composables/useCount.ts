export const useApiUrl = () => {
  const config = useRuntimeConfig()
  return config.public.apiBase
}

export const useImgsUrl = () => {
  const config = useRuntimeConfig()
  return config.public.imgsBase
}
