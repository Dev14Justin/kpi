<footer class="bg-white dark:bg-[#1C1C1C] border-t border-gray-100 dark:border-white/5 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
        <div class="xl:grid xl:grid-cols-3 xl:gap-8">
            <!-- Brand -->
            <div class="space-y-8 xl:col-span-1">
                <a href="{{ route('influencers.index') }}" class="flex items-center gap-2">
                    <div class="h-9 w-9 rounded-xl bg-[var(--kpihub-primary)] flex items-center justify-center font-black text-[var(--kpihub-ink)]">K</div>
                    <span class="text-xl font-bold text-[var(--kpihub-ink)] dark:text-white">KpiHub</span>
                </a>
                <p class="text-gray-500 dark:text-gray-400 text-sm leading-6 max-w-sm">
                    La plateforme ultime pour connecter marques et influenceurs. Pilotez vos campagnes, mesurez vos performances et maximisez votre impact.
                </p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-[var(--kpihub-primary)] transition">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-[var(--kpihub-accent)] transition">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772 4.902 4.902 0 011.772-1.153c.636-.247 1.363-.416 2.427-.465C9.673 2.013 10.03 2 12.315 2zm-3.196 8.45a3.796 3.796 0 115.392 5.392 3.796 3.796 0 01-5.392-5.392zm5.793-2.352a1.034 1.034 0 111.46 1.46 1.034 1.034 0 01-1.46-1.46z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Links -->
            <div class="mt-16 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
                <div class="md:grid md:grid-cols-2 md:gap-8">
                    <div>
                        <h3 class="text-sm font-semibold leading-6 text-[var(--kpihub-ink)] dark:text-white uppercase tracking-wider">Produit</h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li>
                                <a href="{{ route('influencers.index') }}" class="text-sm leading-6 text-gray-500 dark:text-gray-400 hover:text-[var(--kpihub-primary)] transition">Influenceurs</a>
                            </li>
                            <li>
                                <a href="{{ route('ranking.index') }}" class="text-sm leading-6 text-gray-500 dark:text-gray-400 hover:text-[var(--kpihub-primary)] transition">Classement</a>
                            </li>
                            <li>
                                <a href="{{ route('enterprises.index') }}" class="text-sm leading-6 text-gray-500 dark:text-gray-400 hover:text-[var(--kpihub-primary)] transition">Entreprises</a>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-10 md:mt-0">
                        <h3 class="text-sm font-semibold leading-6 text-[var(--kpihub-ink)] dark:text-white uppercase tracking-wider">Support</h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-500 dark:text-gray-400 hover:text-[var(--kpihub-primary)] transition">Centre d'aide</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-500 dark:text-gray-400 hover:text-[var(--kpihub-primary)] transition">Contact</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-500 dark:text-gray-400 hover:text-[var(--kpihub-primary)] transition">FAQ</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="md:grid md:grid-cols-2 md:gap-8">
                    <div>
                        <h3 class="text-sm font-semibold leading-6 text-[var(--kpihub-ink)] dark:text-white uppercase tracking-wider">Légal</h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-500 dark:text-gray-400 hover:text-[var(--kpihub-primary)] transition">Confidentialité</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-500 dark:text-gray-400 hover:text-[var(--kpihub-primary)] transition">CGU</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-16 border-t border-gray-100 dark:border-white/5 pt-8 sm:mt-20 lg:mt-24">
            <p class="text-xs leading-5 text-gray-500 dark:text-gray-400">&copy; {{ date('Y') }} KpiHub. Tous droits réservés.</p>
        </div>
    </div>
</footer>