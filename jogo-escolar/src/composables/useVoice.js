export function useVoice() {

  function startVoice(callback) {
    const SpeechRecognition =
      window.SpeechRecognition || window.webkitSpeechRecognition

    if (!SpeechRecognition) return

    const recognition = new SpeechRecognition()
    recognition.lang = "pt-PT"

    recognition.onresult = (event) => {
      callback(event.results[0][0].transcript)
    }

    recognition.start()
  }

  return { startVoice }
}