export enum AlertType {
  FAIL = 'info',
  SUCCESS = 'success',
  INFO = 'info'
}
interface State {
  isVisibile: boolean,
  content: string,
  type: AlertType,
  showAlert: (content?: string, type?: AlertType) => void;
}

const alertDefault = {
  isVisibile: false,
  content: 'default alert',
  type: AlertType.INFO,
  showAlert(content: string = 'default alert', type: AlertType = AlertType.INFO) {
    this.isVisibile = true
    this.content = content
    this.type = type;
    const myThis = this
    setTimeout(function() {
      myThis.isVisibile = false
    }, 3000)
  }
}

export const useAlert = () => useState<State>('showalert', () => alertDefault);
