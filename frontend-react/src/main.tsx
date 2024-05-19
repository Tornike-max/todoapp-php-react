import React from "react";
import ReactDOM from "react-dom/client";
import App from "./App.tsx";
import "./index.css";
import { QueryClient, QueryClientProvider } from "@tanstack/react-query";
import { ReactQueryDevtools } from "@tanstack/react-query-devtools";
import { NextUIProvider } from "@nextui-org/react";
import { Toaster } from "react-hot-toast";
import AuthContext from "./context/AuthContext.tsx";

const queryClient = new QueryClient({
  defaultOptions: {
    queries: {
      staleTime: 3000,
    },
  },
});
ReactDOM.createRoot(document.getElementById("root")!).render(
  <React.StrictMode>
    <QueryClientProvider client={queryClient}>
      <AuthContext>
        <NextUIProvider>
          <ReactQueryDevtools initialIsOpen={false} />
          <App />
          <Toaster position="top-right" />
        </NextUIProvider>
      </AuthContext>
    </QueryClientProvider>
  </React.StrictMode>
);
