import React from 'react';
import converter from 'number-to-words';
import SplitText from 'react-pose-text';

const charPoses = {
  exit: { opacity: 0, y: -20 },
  enter: {
    opacity: 1,
    y: 0
  }
};

class Oath extends React.Component {
  render() {
    const { count } = this.props;
    const words = converter.toWords(count);

    return (
      <p>I Love You <SplitText initialPose="exit" pose="enter" charPoses={charPoses}>{words}</SplitText>.</p>
    )
  }
}

export default Oath;
