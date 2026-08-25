# Stats Library for PHP WebRTC

[![PHP Version](https://img.shields.io/badge/php-%3E%3D8.2-blue.svg)](https://php.net/)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

A PHP implementation of the WebRTC Statistics API for tracking  RTP, DTLS, and media performance metrics.

## About this fork

This is the `danog/php-rtc-stats` PHP 8.2+ fork used by MadelineProto. It is published separately from upstream and declares that it replaces `quasarstream/stats`.

The forked stack keeps the upstream `quasarstream/*` dependency constraints for compatibility. Each `danog/php-rtc-*` package replaces its upstream counterpart, so consumers select the complete maintained stack by requiring the corresponding danog packages together.

##  Features

- Collect real-time stats from WebRTC components
- Export stats as structured PHP arrays
- Supports timing, packet counters, jitter, and loss metrics
- Designed to match W3C Stats specification

## Requirements

- PHP ≥ 8.2

## Documentation

This package is part of the PHP WebRTC library. For complete documentation, examples, and API reference, visit:

[PHP WebRTC Documentation](https://www.quasarstream.com/php-webrtc)

## Credits

### Authors

- **Amin Yazdanpanah**  
  - Website: [aminyazdanpanah.com](https://www.aminyazdanpanah.com)
  - Email: [github@aminyazdanpanah.com](mailto:github@aminyazdanpanah.com)

- **Sana Moniri**  
  - GtiHub: [sanamoniri](https://github.com/sanamoniri)

## Reporting Issues

Found a bug? Please report it on our [issues](https://github.com/php-webrtc/stats/issues).

## License

BSD 3-Clause License. See [LICENSE](LICENSE) for details.

## References

- [W3C WebRTC Statistics API](https://www.w3.org/TR/webrtc-stats/)
