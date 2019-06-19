import React from 'react';
import logo from './logo.jpeg';
import './App.css';
import Oath from './Oath';

class App extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      oathCount: 3000,
    };
  }

  render() {
    const { oathCount } = this.state;

    return (
      <div className="App">
        <header className="App-header">
          <img src={logo} className="App-logo" alt="logo" />
          <Oath count={oathCount} />
        </header>
      </div>
    );
  }
}

export default App;
