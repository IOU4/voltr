export const useCount = () => useState<number>('counter', () => Math.round(Math.random() * 100))
export const useOtherCount = () => useState<number>('otherCount', () => Math.round(Math.random() * 100))
export const useApiUrl = () => useState('api_url', () => 'http://localhost/api');
