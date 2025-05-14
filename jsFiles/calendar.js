const { useState, useEffect, useRef } = React;

function App() {
  const [breakLength, setBreakLength] = useState(5); // in minutes
  const [sessionLength, setSessionLength] = useState(25); // in minutes
  const [displayTime, setDisplayTime] = useState(25 * 60); // in seconds
  const [play, setPlay] = useState(false);
  const [sessionOrBreak, setSessionOrBreak] = useState('Session');

  const endTimeRef = useRef(null);
  const intervalRef = useRef(null);

  const handleIncrement = (e) => {
    if(!play) {
      const id = e.target.id;
      if (id === 'break-increment') {
        const newBreak = Number(breakLength) + 1;
        setBreakLength(newBreak);
        if (sessionOrBreak === 'Break') setDisplayTime(newBreak * 60);
      } else if (id === 'session-increment') {
        const newSession = Number(sessionLength) + 1;
        setSessionLength(newSession);
        if (sessionOrBreak === 'Session') setDisplayTime(newSession * 60);
      }
    }
  };

  const handleDecrement = (e) => {
    if(!play) {
      const id = e.target.id;
      if (id === 'break-decrement' && breakLength > 1) {
        const newBreak = Number(breakLength) - 1;
        setBreakLength(newBreak);
        if (sessionOrBreak === 'Break') setDisplayTime(newBreak * 60);
      } else if (id === 'session-decrement' && sessionLength > 1) {
        const newSession = Number(sessionLength) - 1;
        setSessionLength(newSession);
        if (sessionOrBreak === 'Session') setDisplayTime(newSession * 60);
      }
    }
  };

  const handleSetBreak = (e) => {
    if(!play) {
      const newBreak = e.target.value.replace(/^0+/, '') || '0';
      setBreakLength(newBreak);
      if (sessionOrBreak === 'Break') setDisplayTime(newBreak * 60);
    }
  };

  const handleSetSession = (e) => {
    if(!play) {
      const newSession = e.target.value.replace(/^0+/, '') || '0';
      setSessionLength(newSession);
      if (sessionOrBreak === 'Session') setDisplayTime(newSession * 60);
    }
  };

  const reset = () => {
    setBreakLength(5);
    setSessionLength(25);
    setDisplayTime(25 * 60);
    setPlay(false);
    setSessionOrBreak('Session');
    clearInterval(intervalRef.current);
    endTimeRef.current = null;
    const beep = document.getElementById('beep');
    beep.pause();
    beep.currentTime = 0;
  };

  const togglePlay = () => {
    setPlay(prev => !prev);
  };
  
  useEffect(() => {
  if (play) {
    if (!endTimeRef.current) {
      endTimeRef.current = Date.now() + displayTime * 1000;
    }

    intervalRef.current = setInterval(() => {
      const now = Date.now();
      const remaining = Math.max(Math.round((endTimeRef.current - now) / 1000), 0);
      setDisplayTime(remaining);

      if (remaining === 0) {
        const audio = document.getElementById('beep');
        audio.play();

        if (sessionOrBreak === 'Session') {
          setSessionOrBreak('Break');
          setDisplayTime(breakLength * 60);
          endTimeRef.current = Date.now() + breakLength * 60 * 1000;
        } else {
          setSessionOrBreak('Session');
          setDisplayTime(sessionLength * 60);
          endTimeRef.current = Date.now() + sessionLength * 60 * 1000;
        }
      }
    }, 1000);
  } else {
    clearInterval(intervalRef.current);
    endTimeRef.current = null;
  }

  return () => {
    clearInterval(intervalRef.current);
  };
}, [play, sessionLength, breakLength, sessionOrBreak]);


  const formatTime = (time) => {
    const hours = Math.floor(time / 3600);
    const minutes = Math.floor((time % 3600) / 60);
    const seconds = time % 60;
    return (
      (hours > 0 ? hours + ':' : '') +
      (minutes < 10 ? '0' + minutes : minutes) +
      ':' +
      (seconds < 10 ? '0' + seconds : seconds)
    );
  };

  return (
    <>
      <h1>Pomodoro</h1>
      <div id="setting">
        <div id="session">
          <h3 id="session-label">Session</h3>
          <button id="session-increment" onClick={handleIncrement}>▲</button>
          <input type="number" id="session-length" value={sessionLength} onChange={handleSetSession}></input>
          <button id="session-decrement" onClick={handleDecrement}>▼</button>
        </div>
        <div id="break">
          <h3 id="break-label">Break</h3>
          <button id="break-increment" onClick={handleIncrement}>▲</button>
          <input type="number" id="break-length" value={breakLength} onChange={handleSetBreak}></input>
          <button id="break-decrement" onClick={handleDecrement}>▼</button>
        </div>
      </div>
      <h2 id="timer-label">{sessionOrBreak} &#9201;</h2>
      <div id="time-left">{formatTime(displayTime)}</div>
      <div id="button-container">
        <button id="start_stop" onClick={togglePlay}>{play ? "II" : "▶"}</button>
        <button id="reset" onClick={reset}>Reset</button>
      </div>
     
      
    </>
  );
}


