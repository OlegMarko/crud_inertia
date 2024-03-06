import { config } from '@vue/test-utils';
import {Ziggy} from "@/ziggy.js";

config.global.mocks.route = () => Ziggy;
